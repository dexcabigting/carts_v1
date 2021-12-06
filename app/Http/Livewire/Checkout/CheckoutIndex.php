<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Support\Str;

use App\Models\Order;
use App\Models\OrderVariant;
use App\Models\Cart;
use App\Models\ProductStock;
use App\Models\UserAddress;

use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationDate;

use Livewire\WithFileUploads;

use App\Events\OrderCreated;

class CheckoutIndex extends Component
{
    use WithFileUploads;

    public $userCarts;
    public $price;
    public $cartQuantity;
    public $pages = 1;
    public $amount;
    public $paymentMethod;
    public $total;
    public $isPaymentSuccessful = 0;
    public $discount;
    public $carts = [];
    public $form = [];
    public $productsAndVariants = [];

    protected function rules()
    {
        return [ 
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
            ],
            3 => [
                'form.amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                'form.type' => ['required', 'string', 'in:card,GCash'],
            ],
            5 => [
                'form.proof' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ], 
        ];
    }

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.phone' => 'phone',
        'form.province' => 'province',
        'form.city' => 'city',
        'form.barangay' => 'barangay',
        'form.home_address' => 'home address',
        'form.amount' => 'amount',
        'form.type' => 'payment method',
        'form.proof' => 'proof of payment',
    ];

    public function mount($ids)
    {
        // testing ends here
        
        $this->carts = json_decode($ids);

        if(!is_array($this->carts)) {
            $this->carts = [$this->carts];
        }

        $this->userCarts = auth()->user()->userCarts($this->carts)->with('product_variant.product')->get();

        $this->discount = 0;

        $this->productsAndVariants = [
            0 => [
                'product' => '',
                'variant' => '',
            ],
        ];

        foreach($this->userCarts as $index => $item) {
            $sum = $item->cartItemSizes()->sum();

            $this->productsAndVariants[$index]['product'] = $item->product_variant->product->prd_name;
            $this->productsAndVariants[$index]['variant'] = $item->product_variant->prd_var_name;

            if($item->product_variant->product->category_id == 1) {
                if($sum >= 10) {
                    $this->discount = $this->discount + (100 * $sum);
                } else {
                    $this->discount = 0.00;
                }
            }
        } 

        $this->cartQuantity = auth()->user()->userCartItems($this->carts)->count();

        $this->selectedAddress = auth()->user()->userAddresses()
                                    ->where('is_main_address', 1)
                                    ->first()->id; 

        $this->form = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'province' => '',
            'city' => '',
            'barangay' => '',
            'home_address' => '',
            // 'postal_code' => '',
            // 'country' => 'PH',
            'amount' => '',
            'type' => '',
            'proof' => '',
        ];
    }

    public function render()
    {
        // dd($this->productsAndVariants);

        $userAddress = $this->user_address->first();

        $this->form['province'] = Str::ucfirst(Str::lower($userAddress->province));
        $this->form['city'] = Str::ucfirst(Str::lower($userAddress->city));
        $this->form['barangay'] = $userAddress->barangay;
        $this->form['home_address'] = $userAddress->home_address;
        $this->form['amount'] = number_format($this->total, 2, ".", "");

        $userAddresses = auth()->user()->userAddresses()
                                ->get()->pluck('id')->toArray(); 

        return view('livewire.checkout.checkout-index', compact('userAddress', 'userAddresses'))->layout('layouts.app-user');
    }

    public function getUserAddressProperty()
    {
        return UserAddress::where('id', $this->selectedAddress);
    }

    public function previousPage()
    {
        $this->resetValidation();

        $this->pages--;
    }

    public function gotoPageTwo()
    {
        $this->validate($this->rules()[$this->pages]);

        $this->pages++;        
    }

    public function gotoPageThree()
    {
        $this->validate($this->rules()[$this->pages]);

        $this->pages++;  
        // User's address will be validated here
    }

    public function gotoPageFour()
    {
        $this->validate($this->rules()[$this->pages]);

        // The total
        $total = round($this->total, 2);

        if($total > +$this->form['amount']) {
            session()->flash('fail', 'The amount you entered is insufficient!');

            return;
        } else if($total < +$this->form['amount']) {
            session()->flash('fail', 'Please enter the exact amount!');

            return;
        } else {
            $this->pages++;
            
            $this->paymentMethod = $this->form['type'];
        }
    }

    public function gotoPageFive()
    {
        // Date will be validated here
        // $this->validate($this->rules()[$this->pages]);
        // dd($this->form);
        $this->pages++;

        // $date = date_create_from_format('Y-m', $this->form['exp_date']);
        // $exp_year = date_format($date, 'y');
        // $exp_month = date_format($date, 'n');

        // $amount = $this->form['amount'];
        // $this->paymentIntent($amount);

        // $type = $this->form['type'];
        // $details = [
        //     'card_number' => $this->form['card_number'],
        //     'exp_month' => $exp_month,
        //     'exp_year' => $exp_year,
        //     'cvc' => $this->form['cvc'],
        // ];
        // $address = [
        //     'province' => $this->form['province'],
        //     'city' => $this->form['city'],
        //     'barangay' => $this->form['barangay'],
        //     'home_address' => $this->form['home_address'],
        //     'postal_code' => $this->form['postal_code'],
        //     'country' => $this->form['country'],
        // ];
        // $info = [
        //     'name' => $this->form['name'],
        //     'email' => $this->form['email'],
        //     'phone' => $this->form['phone'],
        // ];
        // $this->paymentMethod($type, $details, $address, $info);
    }

    public function placeOrder()
    {
        // Re-validate whole form
        
        $rules = collect($this->rules())->collapse()->toArray();

        $this->validate($rules);

        // dd('hello');

        // Do this if user confirms the payment

        // $paymentIntent = Paymongo::paymentIntent()->find(session('paymentIntentId'));

        // $successfulPayment = $paymentIntent->attach(session('paymentMethodId'));

        $this->moveCartstoOrders();

        $this->resetValidation();

        $this->mount(0);

        $this->pages = 1;

        $this->isPaymentSuccessful = 1;

        session()->flash('success', 'Your payment is successful!');
    }

    public function cancelPaymentIntent()
    {
        // $paymentIntent = Paymongo::paymentIntent()->find(session('paymentIntentId'));
        // $cancelPaymentIntent = $paymentIntent->cancel();
        $this->form['proof'] = null;

        $this->resetValidation();

        $this->pages--;
    }

    // private function paymentIntent($amount)
    // {
    //     $paymentIntent = Paymongo::paymentIntent()->create([
    //         'amount' => $amount,
    //         'payment_method_allowed' => [
    //             'card'
    //         ],
    //         'payment_method_options' => [
    //             'card' => [
    //                 'request_three_d_secure' => 'automatic'
    //             ]
    //         ],
    //         'description' => 'This is a test payment intent',
    //         'statement_descriptor' => 'EJ Ezon Sportswear',
    //         'currency' => "PHP",
    //     ]);

    //     session(['paymentIntentId' => $paymentIntent->id]);
    // }

    // private function paymentMethod($type, $details, $address, $info)
    // {
    //     $paymentMethod = Paymongo::paymentMethod()->create([
    //         'type' => $type,
    //         'details' => [
    //             'card_number' => $details['card_number'],
    //             'exp_month' => +$details['exp_month'],
    //             'exp_year' => +$details['exp_year'],
    //             'cvc' => $details['cvc'],
    //         ],
    //         'billing' => [
    //             'address' => [
    //                 'line1' => $address['home_address'] . ' ' . $address['barangay'],
    //                 'city' => $address['city'],
    //                 'state' => $address['province'],
    //                 'country' => $address['country'],
    //                 'postal_code' => $address['postal_code'],
    //             ],
    //             'name' => $info['name'],
    //             'email' => $info['email'],
    //             'phone' => $info['phone'],
    //         ],
    //     ]);

    //     session(['paymentMethodId' => $paymentMethod->id]);
    // }

    private function moveCartsToOrders()
    {
        // Dump something here.

        // Check if an orders record exists. 
        // If yes, the latest record's primary id will be incremented to be the next record's invoice number.
        // Otherwise, invoice number will start from 1.
        
        $transactionFee = round((($this->amount - $this->discount) + 15) / ( (100-3.5) / 100 ) - ($this->amount - $this->discount), 2);

        $discount = $this->discount;
        
        $ordersQuery = Order::query();

        $checkIfOrdersExist = $ordersQuery->first();

        if($checkIfOrdersExist) {
            $invoiceNumber = "EJ-Ezon-" . Str::padLeft($ordersQuery->latest()->first()->id + 1, 6, 0);
        } else {
            $invoiceNumber = "EJ-Ezon-" . Str::padLeft(1, 6, 0);
        }

        $paymentProof = $this->form['proof'];

        $newPaymentProofName = $invoiceNumber . '-' . Str::random(10) . '.' . $paymentProof->extension();
    
        $paymentProofPath = $paymentProof->storeAs('/images/proofs_of_payment', $newPaymentProofName,'public');

        $newOrder = Order::create([
            'invoice_number' => $invoiceNumber,
            'user_id' => auth()->user()->id,
            'user_address_id' => $this->selectedAddress,
            'payment_method' => $this->form['type'],
            'payment_proof' => $paymentProofPath,
            'transaction_fee' => $transactionFee,
            'discount' => $discount,
            'status' => 'Pending',
        ]);

        // Save the product variant(s), that is/are ordered by the user, on order_variants.
        // While saving, the quantity of the product variant must be decremented according to the quantity ordered.
        // The cart items will be moved to order_items .
        
        $cartIds = $this->carts;

        $cartsToBeMoved = auth()->user()->userCarts($cartIds)
                        ->with(['product_variant.product:id,prd_price'])
                        ->with('cart_items')
                        ->get();

        foreach($cartsToBeMoved as $cartToBeMoved) {

            $newOrderVariant = OrderVariant::create([
                'order_id' => $newOrder->id,
                'product_variant_id' => $cartToBeMoved->product_variant_id,
                'amount' => $cartToBeMoved->product_variant->product->prd_price,
            ]);

            $productStock = ProductStock::where('product_variant_id', $cartToBeMoved->product_variant_id)->first();
            $userCartItem = auth()->user()->carts()->where('id', $cartToBeMoved->id)->first()->cartItemSizes()->toArray();

            foreach($userCartItem as $size => $qty) {
                $productStock->decrement($size, $qty);
            }

            foreach($cartToBeMoved->cart_items as $cartItem) {
                $newOrderVariant->order_items()->create([
                    'size' => $cartItem->size,
                    'surname' => $cartItem->surname,
                    'jersey_number' => $cartItem->jersey_number,
                ]);
            }
        }

        $order = $newOrder->load('user:id,name');

        event(new OrderCreated($order));
        
        Cart::whereIn('id', $cartIds)->delete();
    }
}
