<div class="">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="font-bold text-2xl p-3 border-gray-200">    
        {{ $product->prd_name }}
    </div>

    <div class="p-3 border-gray-200 shadow-2xl rounded-lg">    
        <img class="h-40 w-40" src="{{ Storage::url('public/' . $product->prd_image) }}" />
    </div>

    <div class="truncate p-3 border-gray-200">    
        {{ $product->prd_description }}
    </div>

    <div class="p-3 border-gray-200">    
        Available sizes:
            <div class="flex flex-row flex-wrap text-center">
                @foreach($product->product_stock->sizes->toArray() as $column => $value)
                    @if($value > 10)
                        <div class="p-2 border border-gray-300 rounded-lg">
                            {{ $column }}
                            <div class="justify p-2 border border-gray-300 rounded-lg">
                            {{ $value }}
                            </div>
                        </div>
                    @endif    
                @endforeach
            </div>
    </div>

    <div class="flex justify-center mt-4 gap-5">
        <div>
            <x-button type="button" wire:click="closeCartModal()">
                {{ __('Close') }}
            </x-button>
        </div>
        
        <div>
            <x-button>
                {{ __('Add to Cart') }}
            </x-button>
        </div>  
    </div>
    
    
</div>