<div class="">
    <div class="bg-custom-blacki max-w-auto w-96 overflow-hidden shadow-sm sm:rounded-lg p-5">
        <form wire:submit.prevent="placeOrder">
            <div class="flex flex-col gap-5">
                <div class="text-xl font-extrabold text-center text-white">
                    Process Payment
                </div>

                <div>
                    <x-success-fail-message />
                    <x-validation-errors :errors="$errors" />
                </div>

                @if($pages === 1)
                    <div class="text-lg font-bold text-left text-white">
                        Step 1: <span class="text-lg font-normal">Contact Information</span>
                    </div>

                    <div class>
                        <x-label :value="__('Name')" />
                        <x-input wire:model="form.name" class="block mt-1 w-full " type="text" value="{{ Auth::user()->name }}" autofocus required />
                    </div>

                    <div>
                        <x-label :value="__('Email')" />
                        <x-input wire:model="form.email" class="block mt-1 w-full" type="email" value="{{ Auth::user()->email }}" required />
                    </div>

                    <div>
                        <x-label :value="__('Phone')" />
                        <x-input wire:model="form.phone" class="block mt-1 w-full" type="text" value="{{ Auth::user()->phone }}" required />
                    </div>
                @elseif($pages === 2)
                    <div class="text-lg font-bold text-left text-white">
                        Step 2: <span class="text-lg font-normal">Main Address</span>
                    </div>
                    
                    <div class>
                        <x-label :value="__('Region')" />
                        <x-input wire:model="form.region" class="block mt-1 w-full " type="text" value="{{ $userAddress->region }}" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__(Province')" />
                        <x-input wire:model="form.province" class="block mt-1 w-full " type="text" value="{{ $userAddress->province }}" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__('City')" />
                        <x-input wire:model="form.city" class="block mt-1 w-full " type="text" value="{{ $userAddress->city }}" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__(Barangay')" />
                        <x-input wire:model="form.barangay" class="block mt-1 w-full " type="text" value="{{ $userAddress->barangay }}" autofocus required />
                    </div>

                    <div class>
                        <x-label :value="__('Home Address')" />
                        <x-input wire:model="form.home_address" class="block mt-1 w-full " type="text" value="{{ $userAddress->home_address }}" autofocus required />
                    </div>
                @elseif($pages === 3)
                    <div class="text-lg font-bold text-left text-white">
                        Step 3: <span class="text-lg font-normal">Main Address</span>
                    </div>

                    <div>
                        <x-label :value="__('Amount')" />
                        <x-input wire:model.lazy="form.amount" placeholder="Enter amount" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div>
                        <x-label :value="__('Payment Method')" />
                        <div class="flex gap-5 items-center p-1">
                            <input wire:model.lazy="form.type" type="radio" class="form-radio" value="card" checked>
                            <x-label class="inline" :value="__('Credit/Debit Card')" />
                        </div>
                    </div>
                @elseif($pages === 4)
                    @if($paymentMethod == 'card')
                    <div class="text-base font-bold text-left text-white">
                        Card Details
                    </div>

                    <div class>
                        <x-label :value="__('Card Number')" />
                        <x-input wire:model.lazy="form.card_number" placeholder="Enter card number" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div class>
                        <x-label :value="__('Expiration Month')" />
                        <x-input wire:model.lazy="form.exp_month" placeholder="Enter expiration month" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div class>
                        <x-label :value="__('Expiration Year')" />
                        <x-input wire:model.lazy="form.exp_year" placeholder="Enter expiration year" class="block mt-1 w-full" type="text" required />
                    </div>

                    <div class>
                        <x-label :value="__('Card Verification Code (CVC)')" />
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
                                {{ __('Place Order') }}
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
