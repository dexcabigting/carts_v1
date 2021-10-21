<div class="">
    <div class="bg-custom-blacki max-w-auto w-96 overflow-hidden shadow-sm sm:rounded-lg p-5">
        <form wire:submit.prevent="placeOrder">
            <div class="flex flex-col gap-3">
                <div class="text-xl font-extrabold text-center text-white">
                    Payment Process 
                </div>

                <div>
                    <x-success-fail-message />
                    <x-validation-errors :errors="$errors" />
                </div>

                @if($pages === 1)
                    <div class="bg-white relative">
                        <div class="h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute left-10 bottom-2">
                            Step 1: <span class="text-lg font-bold">Contact Information</span>
                        </div>
                    </div>

                    <div class>
                        <x-label :value="__('Name')" />
                        <x-input wire:model.lazy="form.name" class="block mt-1 w-full text-black" type="text" autofocus required />
                    </div>

                    <div>
                        <x-label :value="__('Email')" />
                        <x-input wire:model.lazy="form.email" class="block mt-1 w-full text-black" type="email" required />
                    </div>

                    <div>
                        <x-label :value="__('Phone')" />
                        <x-input wire:model.lazy="form.phone" class="block mt-1 w-full text-black" type="text" required />
                    </div>
                @elseif($pages === 2)
                    <div class="bg-white relative">
                        <div class="w-1/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute left-20 bottom-2">
                            Step 2: <span class="text-lg font-bold">Confirm Address</span>
                        </div>
                    </div>
                    
                    <div class>
                        <x-label :value="__('Province')" />
                        <x-input wire:model="form.province" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__('City')" />
                        <x-input wire:model="form.city" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__('Barangay')" />
                        <x-input wire:model="form.barangay" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__('Home Address')" />
                        <x-input wire:model="form.home_address" class="block mt-1 w-full " type="text" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__('Postal Code')" />
                        <x-input wire:model="form.postal_code" class="block mt-1 w-full " type="text" autofocus required />
                    </div>
                @elseif($pages === 3)
                     <div class="bg-white relative">
                        <div class="w-2/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute left-16 bottom-2">
                            Step 3: <span class="text-lg font-bold">Payment Method</span>
                        </div>
                    </div>

                    <div>
                        <x-label :value="__('Amount')" />
                        <x-input wire:model.lazy="form.amount" placeholder="Enter amount" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div>
                        <x-label :value="__('Payment Method')" />
                        <div class="flex gap-5 items-center p-1">
                            <input wire:model.lazy="form.type" type="radio" class="form-radio" value="card" checked>
                            <x-label class="inline" :value="__('Credit or Debit Card')" />
                        </div>
                    </div>
                @elseif($pages === 4)
                    @if($paymentMethod == 'card')
                    <div class="bg-white relative">
                        <div class="w-3/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute left-20 bottom-2">
                            Step 4: <span class="text-lg font-bold">Card Details</span>
                        </div>
                    </div>

                    <div class>
                        <x-label :value="__('Card Number')" />
                        <x-input wire:model.lazy="form.card_number" placeholder="Enter card number" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div class>
                        <x-label :value="__('Expiration Date')" />
                        <x-input wire:model.lazy="form.exp_date" placeholder="Enter expiration date" class="block mt-1 w-full" type="date" required />
                    </div>

                    <div class>
                        <x-label :value="__('Card Verification Code')" />
                        <x-input wire:model.lazy="form.cvc" placeholder="Enter cvc" class="block mt-1 w-full" type="text" required />
                    </div>
                    @endif
                @elseif($pages === 5)
                    @if($paymentMethod == 'card')
                    <div class="bg-white relative">
                        <div class="w-4/4 bg-green-500 h-10">
                        </div>
                        <div class="text-lg font-bold text-gray-600 absolute left-20 bottom-2">
                            Step 4: <span class="text-lg font-bold">Card Details</span>
                        </div>
                    </div>

                    <div class>
                        <x-label :value="__('Card Number')" />
                        <x-input wire:model.lazy="form.card_number" placeholder="Enter card number" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div class>
                        <x-label :value="__('Expiration Date')" />
                        <x-input wire:model.lazy="form.exp_date" placeholder="Enter expiration date" class="block mt-1 w-full" type="date" required />
                    </div>

                    <div class>
                        <x-label :value="__('Card Verification Code')" />
                        <x-input wire:model.lazy="form.cvc" placeholder="Enter cvc" class="block mt-1 w-full" type="text" required />
                    </div>
                    @endif
                @endif

                <div>
                    @if($pages === 1)
                        <div class="text-right">
                            <x-button wire:click.prevent="gotoPageTwo" type="button" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @elseif($pages === 2)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="previousPage" type="button" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Back') }}
                            </x-button>

                            <x-button wire:click.prevent="gotoPageThree" type="submit" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @elseif($pages === 3)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="previousPage" type="button" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Back') }}
                            </x-button>

                            <x-button wire:click.prevent="gotoPageFour" type="submit" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @elseif($pages === 4)
                        <div class="flex justify-between">
                            <x-button wire:click.prevent="previousPage" type="button" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Back') }}
                            </x-button>

                            <x-button type="submit" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-lg font-bold text-white px-4 py-2 bg-custom-violet">
                                {{ __('Next') }}
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
