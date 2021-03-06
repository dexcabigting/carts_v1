<div class="">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex justify-around">
        <div>
            <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
                {{ __('Edit Cart') }}
            </h2>
        </div>
    </div>

    <div class="justify-around">
        <div>
            <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
                {{ __('Available Sizes') }}
            </h2>
        </div>

        <div class="flex flex-row gap-5 text-white">
            <div>
                2XS: {{ $sizes->{'2XS'} }}
            </div>

            <div>
                XS: {{ $sizes->XS }}
            </div>

            <div>
                S: {{ $sizes->S }}
            </div>

            <div>
                M: {{ $sizes->M }}
            </div>

            <div>
                L: {{ $sizes->L }}
            </div>

            <div>
                XL: {{ $sizes->XL }}
            </div>

            <div>
                2XL: {{ $sizes->{'2XL'} }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-4 justify-items-center gap-3 text-center">
        <div class="">
            <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
                {{ __('Size') }}
            </h2>
        </div>

        <div class="">
            <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
                {{ __('Surname') }}
            </h2>
        </div>

        <div class="">
            <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
                {{ __('Number') }}
            </h2>
        </div>

        <div class="">
            <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
                {{ __('Remove') }}
            </h2>
        </div>
    </div>

    <form wire:submit.prevent="update">
        @foreach($cartItems as $index => $cartItem)
        <div class="grid grid-cols-4 justify-items-center gap-3 pb-3" wire:key="{{ $loop->index }}-cart-item">
            <input type="hidden" wire:model.defer="cartItems.{{ $index }}.id">

            <div class="">
                <select wire:model.defer="cartItems.{{ $index }}.size" class="border-gray-300 rounded-lg w-full">
                    <option value="">
                        ---
                    </option>                    
                    @foreach($sizes->sizes->toArray() as $column => $value)
                        @if($value > 0)
                        <option value="{{ $column }}">
                            {{ $column }}
                        </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="">
                <x-input wire:model.defer="cartItems.{{ $index }}.surname" class="block w-full" type="text" autofocus />
            </div>

            <div class="">
                <x-input wire:model.defer="cartItems.{{ $index }}.jersey_number" class="block w-full" type="text" autofocus />
            </div>

            @if(count($cartItems) == 1)
            <div class="text-center">
                <x-button wire:click.prevent="addMore">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#ffffff" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-button>
            </div>
            @else
            <div>
                <x-button type="button" wire:click.prevent="removeCartItem({{ $index }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#ffffff" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-button>
            </div>
            @endif
        </div>
        @endforeach

        <div class="flex flex-col mt-4 gap-5">
            @if(count($cartItems) != 1)
            <div class="text-center">
                <x-button wire:click.prevent="addMore" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#ffffff" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-button>
            </div>
            @endif

            <div class="text-right text-white text-xl mb-8">
                Total: &#8369;{{ number_format($totalAmount, 2) }}
            </div>
        </div>

        <div class="flex justify-center mt-4 gap-5 text-2xl">
            <div>
                <x-button class="text-white font-bold bg-custom-violet px-12 py-4" type="submit">
                    {{ __('Update Cart') }}
                </x-button>
            </div>

            <div>
                <x-button class="text-white font-bold bg-red-600 px-12 py-4" type="button" wire:click.prevent="closeCartModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>

</div>
