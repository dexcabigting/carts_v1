<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

// Twilio Phone Lookup
use App\Service\Twilio\PhoneNumberLookupService;
use App\Rules\PhoneNumber;

use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */

    private $service;

    public function __construct(PhoneNumberLookupService $service)
    {
        $this->service = $service;
    }

    public function index_email()
    {
        return view('auth.forgot-password-email');
    }

    public function index_phone()
    {
        return view('auth.forgot-password-phone');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function store_phone(Request $request)
    {
        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $request->input('phone'));

        $request->offsetSet('phone', $phone);

        $phone = $request->validate([
            'phone' => ['required', 'string', 'exists:users', new PhoneNumber($this->service)],
        ]);

        $message = mt_rand(1000, 9999);

        $user = User::where(['phone' => $phone])->first();

        $user->otp = $message;

        $user->save();

        $token = Str::random(30);

        session(['token' => $token]) ;

        $shown_token = sha1($token.$user->id.$token);

        // Open connection
        $to = $user->phone;
        $from = getenv("TWILIO_FROM");
        $message = $user->otp;

        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages.json', getenv("TWILIO_SID")));
        curl_setopt($ch, CURLOPT_POST, 3);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='. $to . '&From=' . $from . '&Body=' . $message);

        // Execute post
        $result = curl_exec($ch);
        $result = json_decode($result);

        // Close connection
        curl_close($ch);
        // Sending message ends here

        return redirect()->route('password.reset-phone', [$user, 'token' => $shown_token]);
    }
}
