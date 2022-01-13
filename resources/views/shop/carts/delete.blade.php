<div>
    <x-success-fail-message />

    @if($promptDelete)
    <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
        @if (count($carts) == 1)
        {{ __('Are you sure you want to delete this cart?') }}
        @else
        {{ __('Are you sure you want to delete these carts?') }}
        @endif
    </h2>

    <div class="flex items-center justify-center mt-4 gap-5 text-white text-xl">
        <div>
            <x-button class="bg-custom-violet py-2 px-8 font-bold " type="button" wire:click.prevent="deleteCarts()">
                {{ __('Yes') }}
            </x-button>
        </div>

        <div>
            <x-button class="bg-red-500 py-2 px-4 font-bold " type="button" wire:click.prevent="closeDeleteCartModal()">
                {{ __('Cancel') }}
            </x-button>
        </div>
    </div>
    @elseif($promptDeleted)
    <div class="flex justify-center items-center mt-4">
        <div class="flex">
            <x-button class="bg-red-500 text-white hover:bg-red-400 text-xl px-4 py-2 font-bold" type="button" wire:click.prevent="closeDeleteCartModal()">
                {{ __('Close') }}
            </x-button>
        </div>
    </div>
    @endif
</div>
