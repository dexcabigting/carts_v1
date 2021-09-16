<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    //
    public function sms_index()
    {
        return view('sms.index');
    }

    public function sms_send(Request $request)
    {
        // $phone = ;
        // $msg = $request->msg;

        // dd($phone, $msg);

        // return request();

        // Open connection
        $to = $request->phone;
        $from = getenv("TWILIO_FROM");
        $message = $request->msg;
       

        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages.json', getenv("TWILIO_SID")));
        curl_setopt($ch, CURLOPT_POST, 3);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.$message);

        // Execute post
        $result = curl_exec($ch);
        $result = json_decode($result);

        // Close connection
        curl_close($ch);
        //Sending message ends here

        return [$result];
    }


}
