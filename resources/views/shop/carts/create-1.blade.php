<div class="">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex justify-around">
        <div>
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Add to Cart') }}
            </h2>
        </div>
    </div>

    <div class="grid grid-cols-4 justify-items-center gap-3 text-center">
        <div class="">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Size') }}
            </h2>
        </div>

        <div class="">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Surname') }}
            </h2>
        </div>

        <div class="">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Number') }}
            </h2>
        </div>

        <div class="">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Remove') }}
            </h2>
        </div>
    </div>

    <form action="POST" wire:submit.prevent="store">
        @foreach($addItems as $index => $addItem)
        <div class="grid grid-cols-4 justify-items-center gap-3 pb-3">
            <div class="">
                
            </div>

            <div class="">
                <x-input wire:model.defer="addItems.{{ $index }}.surname" class="block w-full" type="text" autofocus />
            </div>

            <div class="">
                <x-input wire:model.defer="addItems.{{ $index }}.jersey_number" class="block w-full" type="text" autofocus />
            </div>

            <div>
                <x-button type="button" wire:click.prevent="removeItem({{ $index }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-button>
            </div>
        </div>
        @endforeach

        <div class="flex justify-between mt-4 gap-5 text-center">
            <div>
                <x-button type="button" wire:click.prevent="addMore">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-button>
            </div>

            <div class="pr-5 self-center">
                Total: &#8369;{{ number_format($totalAmount, 2) }}
            </div>
        </div>

        <div class="flex justify-center mt-4 gap-5">
            <div>
                <x-button type="button" wire:click.prevent="closeCartModal()">
                    {{ __('Close') }}
                </x-button>
            </div>

            <div>
                <x-button>
                    {{ __('Add to Cart') }}
                </x-button>
            </div>
        </div>
    </form>

</div>
