<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckoutIndex extends Component
{
    public $userCarts;
    public $price;
    public $cartQuantity;
    public $carts = [];
    public $userAddress;
    public $pages = 1;
    public $amount;
    public $form = [];
    public $paymentMethod;

    protected $rules = [
        1 => [
            'form.name' => ['required', 'string', 'exists:users,name'],
            'form.email' => ['required', 'string', 'exists:users,email'],
            'form.phone' => ['required', 'string', 'exists:users,phone'],
        ],
        2 => [
            'form.province' => ['required', 'string', 'exists:user_addresses,province'],
            'form.city' => ['required', 'string', 'exists:user_addresses,city'],
            'form.barangay' => ['required', 'string', 'exists:user_addresses,barangay'],
            'form.home_address' => ['required', 'string', 'exists:user_addresses,home_address'],
            'form.postal_code' => ['required', 'string'],
            'form.country' => ['required', 'string', 'in:PH'],
        ],
        3 => [
            'form.amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
            'form.type' => ['required', 'string', 'in:card,gcash'],
        ],
        4 => [
            'form.card_number' => ['required', 'string'],
            'form.exp_date' => ['required', 'string', 'date_format:Y-m-d','after:today'],
            'form.cvc' => ['required', 'string'],
        ], 
    ];

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.phone' => 'phone',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
        'form.postal_code' => 'postal code',
        'form.amount' => 'amount',
        'form.type' => 'payment method',
        'form.card_number' => 'card number',
        'form.exp_date' => 'expiration date',
        'form.cvc' => 'card validation code',
    ];

    public function mount($ids)
    {
        // dd(auth()->user()->phone);
        $this->carts = json_decode($ids);

        $this->userCarts = auth()->user()->userCarts($this->carts)->with('product_variant.product')->get();

        $this->cartQuantity = auth()->user()->userCartItems($this->carts)->count();

        $this->userAddress = auth()->user()->addresses()->where('is_main_address', 1)->first();

        $this->form = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'province' => Str::ucfirst(Str::lower($this->userAddress->province)),
            'city' => Str::ucfirst(Str::lower($this->userAddress->city)),
            'barangay' => $this->userAddress->barangay,
            'home_address' => $this->userAddress->home_address,
            'postal_code' => '4005',
            'country' => 'PH',
            'amount' => '',
            'type' => '',
            'card_number' => '4009930000001421',
            'exp_date' => '',
            'cvc' => '',
        ];
    }

    public function gotoPageTwo()
    {
        $this->validate($this->rules[$this->pages]);

        $this->pages++;        
    }

    public function gotoPageThree()
    {
        $this->validate($this->rules[$this->pages]);

        $this->pages++;  
        // User's address will be validated here
    }

    public function gotoPageFour()
    {
        $this->validate($this->rules[$this->pages]);

        $amount = $this->amount;

        if($amount > $this->form['amount']) {
            session()->flash('fail', 'The amount you entered is insufficient!');

            return;
        } else {
            $this->pages++;
            
            $this->paymentMethod = 'card';
        }
    }

    public function placeOrder()
    {
        // Date will be validated here
        $this->validate($this->rules[$this->pages]);
        $date = date_create_from_format('Y-m-d', $this->form['exp_date']);
        $exp_year = date_format($date, 'y');
        $exp_month = date_format($date, 'n');

        // Re-validate whole form
        $rules = collect($this->rules)->collapse()->toArray();

        $this->validate($rules);

        $amount = $this->form['amount'];
        $this->paymentIntent($amount);

        $type = $this->form['type'];
        $details = [
            'card_number' => $this->form['card_number'],
            'exp_month' => $exp_month,
            'exp_year' => $exp_year,
            'cvc' => $this->form['cvc'],
        ];
        $address = [
            'province' => $this->form['province'],
            'city' => $this->form['city'],
            'barangay' => $this->form['barangay'],
            'home_address' => $this->form['home_address'],
            'postal_code' => $this->form['postal_code'],
            'country' => $this->form['country'],
        ];
        $info = [
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
        ];
        $this->paymentMethod($type, $details, $address, $info);

        $paymentIntent = Paymongo::paymentIntent()->find(session('paymentIntentId'));
        $paymentMethod = Paymongo::paymentMethod()->find(session('paymentMethodId'));

        // Do this if user confirms the payment
        $successfulPayment = $paymentIntent->attach(session('paymentMethodId'));

        // Do this if user cancels payment
        $cancelPaymentIntent = $paymentIntent->cancel();

        dd($paymentIntent, $paymentMethod, $successfulPayment);

        $this->reset();
        $this->resetValidation();
    }


    public function previousPage()
    {
        $this->pages--;
    }

    private function paymentIntent($amount)
    {
        $paymentIntent = Paymongo::paymentIntent()->create([
            'amount' => $amount,
            'payment_method_allowed' => [
                'card'
            ],
            'payment_method_options' => [
                'card' => [
                    'request_three_d_secure' => 'automatic'
                ]
            ],
            'description' => 'This is a test payment intent',
            'statement_descriptor' => 'EJ Ezon Sportswear',
            'currency' => "PHP",
        ]);

        session(['paymentIntentId' => $paymentIntent->id]);
    }

    private function paymentMethod($type, $details, $address, $info)
    {
        $paymentMethod = Paymongo::paymentMethod()->create([
            'type' => $type,
            'details' => [
                'card_number' => $details['card_number'],
                'exp_month' => +$details['exp_month'],
                'exp_year' => +$details['exp_year'],
                'cvc' => $details['cvc'],
            ],
            'billing' => [
                'address' => [
                    'line1' => $address['home_address'] . ' ' . $address['barangay'],
                    'city' => $address['city'],
                    'state' => $address['province'],
                    'country' => $address['country'],
                    'postal_code' => $address['postal_code'],
                ],
                'name' => $info['name'],
                'email' => $info['email'],
                'phone' => $info['phone'],
            ],
        ]);

        session(['paymentMethodId' => $paymentMethod->id]);
    }

    public function render()
    {
        return view('livewire.checkout.checkout-index')->layout('layouts.app-user');
    }
}
