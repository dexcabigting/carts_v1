<div class="bg-custom-blacki">
    <x-success-fail-message />

    @if($promptDelete)   
        <div>
            <h1 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
                WARNING
            </h1>
        </div>
         
        <div class="font-semibold text-l text-gray-100 leading-tight mb-4">
            @if(count($products) == 1)
                <div>
                    Associated records with this product will be affected.
                </div>
                <div>
                    Are you sure you want to delete this product?
                </div>
            @else
                <div>
                    Associated records with these products will be affected.
                </div>
                <div>
                    Are you sure you want to delete these products?
                </div>
            @endif 
        </div>
    
        <div class="flex justify-center items-center mt-4 gap-5 ">
            <div class="bg-custom-violet text-xl text-white">
                <x-button class="font-bold px-6 py-2" type="button" wire:click.prevent="deleteProducts">
                    {{ __('Yes') }}
                </x-button>
            </div>
            
            <div class="bg-red-500 text-xl text-white">
                <x-button class="font-bold px-3 py-2" type="button" wire:click.prevent="closeDeleteModal">
                    {{ __('Cancel') }}
                </x-button>
            </div>  
        </div>
    @elseif($promptDeleted)
        <div class="flex mt-4">
            <div>
                <x-button type="button" wire:click.prevent="closeDeleteModal">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    @endif
</div>
