<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

// Twilio Phone Lookup
use App\Service\Twilio\PhoneNumberLookupService;
use App\Rules\PhoneNumber;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    private $service;

    public function __construct(PhoneNumberLookupService $service)
    {
        $this->service = $service;
    }


    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request);
        // preg_replace($request->input('phone'));
        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $request->input('phone'));

        $request->offsetSet('phone', $phone);

        // dd($request->phone);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => ['required', 'string', 'unique:users', new PhoneNumber($this->service)],
            'region' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'home_address' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->addresses()->create([
            'region' => $request->region,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'home_address' => $request->home_address,
            'is_main_address' => 1,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('welcome');
        // return redirect(RouteServiceProvider::HOME);
    }
}
