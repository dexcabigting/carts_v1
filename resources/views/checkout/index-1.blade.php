<div class="w-3/5">
    <div class="bg-custom-blacki max-w-auto overflow-hidden shadow-sm sm:rounded-lg p-5">
        <form wire:submit.prevent="placeOrder">
            @csrf
            <div class="flex flex-col gap-3">
                <div class="text-xl font-extrabold text-center text-white">
                    Payment Process {{ $pages }}
                </div>

                <div>
                    <x-success-fail-message />
                    <x-validation-errors :errors="$errors" />
                </div>

                @if($pages === 1)
                    @if(count($userCarts) != 0)
                        <div class="bg-white relative">
                            <div class="h-10">
                            </div>
                            <div class="text-lg font-bold text-gray-600  absolute bottom-1/4 left-1/4">
                                Step 1: <span class="text-lg font-bold">Contact Information</span>
                            </div>
                        </div>

                        <div>
                            <x-label :value="__('Name')" />
                            <x-input wire:model="form.name" class="block mt-1 w-full text-black" type="text" autofocus required />
                        </div>

                        <div>
                            <x-label :value="__('Email')" />
                            <x-input wire:model="form.email" class="block mt-1 w-full text-black" type="email" required />
                        </div>

                        <div>
                            <x-label :value="__('Phone')" />
                            <x-input wire:model="form.phone" class="block mt-1 w-full text-black" type="text" required />
                        </div>
                    @elseif($isPaymentSuccessful == 0)
                        <div>
                            <div class="text-center font-bold">
                                <h1>There is nothing to checkout!</h1>
                            </div>
                        </div>
                    @endif
                @elseif($pages === 2)
                    <div class="bg-white relative">
                        <div class="w-1/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute bottom-1/4 left-1/4">
                            Step 2: <span class="text-lg font-bold">Confirm Address</span>
                        </div>
                    </div>
                    
                    <div>
                        <x-label :value="__('Province')" />
                        <x-input wire:model="form.province" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div>
                        <x-label :value="__('City')" />
                        <x-input wire:model="form.city" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div>
                        <x-label :value="__('Barangay')" />
                        <x-input wire:model="form.barangay" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div>
                        <x-label :value="__('Home Address')" />
                        <x-input wire:model="form.home_address" class="block mt-1 w-full " type="text" autofocus required />
                    </div>
                @elseif($pages === 3)
                    <div class="bg-white relative">
                        <div class="w-2/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute bottom-1/4 left-1/4">
                            Step 3: <span class="text-lg font-bold">Payment Method</span>
                        </div>
                    </div>

                    <div>
                        <x-label :value="__('Amount')" />
                        <x-input wire:model="form.amount" placeholder="Enter amount" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div>
                        <x-label :value="__('Payment Method')" />
                        <div class="flex flex-col gap-5 p-1">
                            <div>
                                <input wire:model="form.type" type="radio" value="GCash">
                                <x-label class="inline" :value="__('GCash')" />
                            </div>
                        </div>
                    </div>
                @elseif($pages === 4)
                    
                        <div class="bg-white relative">
                            <div class="w-3/4 bg-green-500 h-10">
                            </div>
                            <div class="text-lg font-bold text-gray-600 absolute bottom-1/4 left-1/4">
                                Step 4: <span class="text-lg font-bold">Confirm your order details!</span>
                            </div>
                        </div>

                        <div class="bg-white flex flex-col p-5 gap-5 rounded-lg">
                            <div class="text-center font-bold">
                                <h1>Order Details</h1>
                            </div>

                            <div>
                                <div>
                                    <span class="font-semibold">Name:</span> {{ $form['name'] }}
                                </div>

                                <div>
                                    <span class="font-semibold">Email:</span> {{ $form['email'] }}
                                </div>

                                <div>
                                    <span class="font-semibold">Phone:</span> {{ $form['phone'] }}
                                </div>

                                <div class="flex flex-row gap-1">
                                    <div>
                                        <span class="font-semibold">Address: </span>
                                    </div>
                                    <div>
                                        {{ $form['home_address'] }}, {{ $form['barangay'] }}, {{ ucwords($form['city']) }}, {{ $form['province'] }}
                                    </div>                                      
                                </div>
                            </div>

                            <div>
                                <div>
                                    <span class="font-semibold">Product and Variant:</span>                                                       
                                </div>
                            </div>

                            <div>
                                <div>
                                    <span class="font-semibold">Payment Method:</span> {{ ucfirst($form['type']) }}
                                </div>

                                <div>
                                    <span class="font-semibold">Amount to Pay:</span> &#8369;{{ number_format($total, 2) }}
                                </div>
                            </div>
                        </div></div>
                    
                @elseif($pages === 5)
                    <div class="bg-white relative">
                        <div class="w-4/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute bottom-1/4 left-1/4">
                            Step 5: <span class="text-lg font-bold">Proof of Payment</span>
                        </div>
                    </div>

                    <div class="bg-white flex flex-col p-5 gap-5 rounded-lg">
                        <div class="text-center text-xl">
                            Please scan this QR code and upload your proof of payment.
                        </div>

                        <div>
                            <img src="{{ asset('images\GCash_QR_Sample.jpg') }}">
                        </div>
                    </div>
                @endif
                <div>
                    @if($pages === 1)
                        @if(count($userCarts) != 0)
                            <div class="text-right">
                                <x-button wire:click.prevent="gotoPageTwo" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                    {{ __('Next') }}
                                </x-button>
                            </div>
                        @endif
                    @elseif($pages === 2)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="previousPage" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Back') }}
                            </x-button>

                            <x-button wire:click.prevent="gotoPageThree" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @elseif($pages === 3)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="previousPage" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Back') }}
                            </x-button>

                            <x-button wire:click.prevent="gotoPageFour" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @elseif($pages === 4)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="previousPage" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Back') }}
                            </x-button>

                            <x-button wire:click.prevent="gotoPageFive" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @elseif($pages === 5)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="cancelPaymentIntent" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Cancel Payment') }}
                            </x-button>

                            <x-button type="submit" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Place Order') }}
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
