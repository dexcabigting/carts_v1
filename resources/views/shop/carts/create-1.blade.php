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

    <div class="flex flex-row gap-6 text-center">
        <div class="flex-grow">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Size') }}
            </h2>
        </div>

        <div class="flex-grow">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Surname') }}
            </h2>
        </div>

        <div class="flex-grow">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Number') }}
            </h2>
        </div>

        <div class="flex-grow">
            <h2 class="font-semibold text-l text-gray-800 leading-tight mb-4">
                {{ __('Remove') }}
            </h2>
        </div>
    </div>

    @foreach($addItems as $index => $addItem)
        <div class="flex flex-row flex-wrap gap-6 pb-3">
            <div class="">    
                <select wire:model="addItems.{{$index}}.size" class="border-gray-300 rounded-lg">
                    @foreach($product->product_stock->sizes->toArray() as $column => $value)
                        @if($value > 10)
                            <option>
                            {{ $column }}
                            </option>
                        @endif    
                    @endforeach
                </select>
            </div>

            <div class="">    
                <x-input wire:model="addItems.{{$index}}.surname" class="block w-10" type="text" autofocus />
            </div>

            <div class="">    
                <x-input wire:model="addItems.{{$index}}.jersey_num" class="block w-10" type="text" autofocus />
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

    <div class="flex justify-center mt-4 gap-5">       
        <div>
            <x-button type="button" wire:click.prevent="addMore">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-button>
        </div>  
    </div> 
</div>