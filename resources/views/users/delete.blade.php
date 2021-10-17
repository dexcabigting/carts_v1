<div>
    <x-success-fail-message />

    @if($promptDelete)   
        <h2 class="font-semibold text-l text-gray-100 leading-tight mb-4">
            @if(count($users) == 1)
                {{ __('Are you sure you want to delete this user?') }}
            @else
                {{ __('Are you sure you want to delete these users?') }}
            @endif 
        </h2>
    
        <div class="flex mt-4 gap-5 justify-center">
            <div>
                <x-button class="bg-custom-violet text-gray-100 text-xl font-bold px-8 py-2" type="button" wire:click.prevent="deleteUsers()">
                    {{ __('Yes') }}
                </x-button>
            </div>
            
            <div>
                <x-button class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2" type="button" wire:click.prevent="closeDeleteModal()">
                    {{ __('Cancel') }}
                </x-button>
            </div>  
        </div>
    @elseif($promptDeleted)
        <div class="flex mt-4 justify-center">
            <div>
                <x-button type="button" wire:click.prevent="closeDeleteModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    @endif
</div>