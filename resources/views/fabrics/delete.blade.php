<div>
    <x-success-fail-message />

    @if($promptDelete)   
        <div>
            <h1 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
                WARNING
            </h1>
        </div>
         
        <div class="font-semibold text-l text-gray-100 leading-tight mb-4">
            @if(count($fabrics) == 1)
                <div>
                    Associated records with this fabric will be affected.
                </div>
                <div>
                    Are you sure you want to delete this fabric?
                </div>
            @else
                <div>
                    Associated records with these fabrics will be affected.
                </div>
                <div>
                    Are you sure you want to delete these fabrics?
                </div>
            @endif 
        </div>
    
        <div class="flex mt-4 gap-5 justify-center">
            <div>
                <x-button type="button" wire:click.prevent="deleteFabrics" class="bg-custom-violet text-gray-100 text-xl font-bold px-8 py-2">
                    {{ __('Yes') }}
                </x-button>
            </div>
            
            <div>
                <x-button type="button" wire:click.prevent="closeDeleteModal" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                    {{ __('Cancel') }}
                </x-button>
            </div>  
        </div>
    @elseif($promptDeleted)
        <div class="flex mt-4 justify-center text-xl">
            <div>
                <x-button class="bg-custom-violet px-4 py-2 text-white" type="button" wire:click.prevent="closeDeleteModal">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    @endif
</div>
