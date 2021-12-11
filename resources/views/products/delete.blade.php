<div class="bg-custom-blacki">
    <x-success-fail-message />

    @if($promptDelete)   
        <h2 class=" font-semibold text-l text-gray-100 leading-tight mb-4">
            @if (count($products) == 1)
                {{ __('Are you sure you want to delete this product?') }}
            @else
            {{ __('Are you sure you want to delete these products?') }}
            @endif 
        </h2>
    
        <div class="flex justify-center items-center mt-4 gap-5 ">
            <div class="bg-custom-violet text-xl text-white">
                <x-button class="font-bold px-6 py-2" type="button" wire:click.prevent="deleteProducts()">
                    {{ __('Yes') }}
                </x-button>
            </div>
            
            <div class="bg-red-500 text-xl text-white">
                <x-button class="font-bold px-3 py-2" type="button" wire:click.prevent="closeDeleteModal()">
                    {{ __('Cancel') }}
                </x-button>
            </div>  
        </div>
    @elseif($promptDeleted)
        <div class="flex mt-4">
            <div>
                <x-button type="button" wire:click.prevent="closeDeleteModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    @endif
</div>

