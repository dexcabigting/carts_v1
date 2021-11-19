<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;

class PaymentController extends Controller
{
    //
    public function index()
    {
        $userAddress = auth()->user()->userAddresses()->where('is_main_address', 1)->first();

        return view('payment.index', compact('userAddress'));
    }

    public function store(Request $request)
    {
        $paymentMethod = Paymongo::paymentMethod()->create([
            'type' => $request->input('type'),
            'details' => [
                'card_number' => $request->input('details.card_number'),
                'exp_month' => +$request->input('details.exp_month'),
                'exp_year' => +$request->input('details.exp_year'),
                'cvc' => $request->input('details.cvc'),
            ],
            'billing' => [
                'address' => [
                    'line1' => $request->input('billing.address.line1'),
                    'city' => $request->input('billing.address.city'),
                    'state' => $request->input('billing.address.state'),
                    'country' => $request->input('billing.address.country'),
                    'postal_code' => $request->input('billing.address.postal_code'),
                ],
                'name' => $request->input('billing.name'),
                'email' => $request->input('billing.email'),
                'phone' => $request->input('billing.phone'),
            ],
        ]);

        dd($paymentMethod);

        return redirect()->route('payment.index');
    }

}
