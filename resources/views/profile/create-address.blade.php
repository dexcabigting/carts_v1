<div>
    Hello
    <div class="flex justify-center items-center gap-5"> 
        <div>
            <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="store()">
                {{ __('Save') }}
            </x-button>
        </div>
        <div>
            <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="closeCreateModal()">
                {{ __('Close') }}
            </x-button>
        </div>
    </div>
</div>    
    
