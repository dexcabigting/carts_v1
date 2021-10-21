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
    public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'region' => '',
        'province' => '',
        'city' => '',
        'barangay' => '',
        'home_address' => '',
        'country' => '',
        'amount' => '',
        'type' => '',
        'card_number' => '',
        'exp_date' => '',
        'cvc' => '',
    ];
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
            'form.country' => ['required', 'string', 'in:PH'],
        ],
        3 => [
            'form.amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
            'form.type' => ['required', 'string', 'in:card,gcash'],
        ],
        4 => [
            'form.card_number' => ['required'],
            'form.exp_date' => ['required', 'string', 'date_format:Y-m','after:today'],
            'form.cvc' => ['required', 'string'],
        ], 
    ];

    protected $validationAttributes = [
        'form.amount' => 'amount',
        'form.type' => 'payment method',
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
            'country' => 'PH',
            'amount' => '',
            'type' => '',
            'card_number' => 4009930000001421,
            'exp_month' => '',
            'exp_year' => '',
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

    public function previousPage()
    {
        $this->pages--;
    }

    public function placeOrder()
    {
        // dd($this->form['exp_date']);
        $this->validate($this->rules[$this->pages]);
        $date = date_create_from_format('Y-m', $this->form['exp_date']);
        $exp_year = date_format($date, 'y');
        $exp_month = date_format($date, 'n');
        dd(+$exp_year, +$exp_month);
        $rules = collect($this->rules)->collapse()->toArray();

        $this->validate($rules);


        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.checkout.checkout-index')->layout('layouts.app-user');
    }
}
