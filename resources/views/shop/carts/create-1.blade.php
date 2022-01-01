<div class="flex flex-col gap-5 p-5 h-auto overflow-y-auto">

    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex justify-around">
        <div>
            <h2 class="font-semibold text-l leading-tight ">
                {{ __('Add to Cart') }}
            </h2>
        </div>
    </div>

    <div>
        <select wire:model="selectVariant" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
            @foreach($productVariants as $index => $productVariant)
            <option value="{{ $productVariant->id }}">
                <x-label value="{{ $productVariant->prd_var_name }}" class="inline-block" />
            </option>
            @endforeach
        </select>
    </div>

    @if(!$this->variant_in_cart)
        <div class="grid grid-cols-4 justify-items-center gap-3 text-center">
            <div class="">
                <h2 class="font-semibold text-l leading-tight ">
                    {{ __('Size') }}
                </h2>
            </div>

            <div class="">
                <h2 class="font-semibold text-l leading-tight ">
                    {{ __('Surname') }}
                </h2>
            </div>

            <div class="">
                <h2 class="font-semibold text-l leading-tight ">
                    {{ __('Number') }}
                </h2>
            </div>

            <div class="">
                <h2 class="font-semibold text-l leading-tight ">
                    @if(count($addItems) == 1)
                        {{ __('Add') }}
                    @else() 
                        {{ __('Remove') }}
                    @endif
                </h2>
            </div>
        </div>

        <div class="max-h-96 overflow-y-auto">
            <form action="POST" wire:submit.prevent="store">
                @foreach($addItems as $index => $addItem)
                <div class="grid grid-cols-4 justify-items-center gap-5 mb-5" wire:key="item-{{ $loop->index }}">
                    <div wire:key="item-{{ $loop->index }}-dropdown" class="ml-7">
                        <select wire:model="addItems.{{ $index }}.size" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                <option value="" selected>
                                    ---
                                </option>
                            @foreach($stocks->sizes->toArray() as $column => $value)
                                @if($value > 0)
                                    <option value="{{ $column }}">
                                        {{ $column }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div wire:key="item-{{ $loop->index }}-surname" class="ml-3">
                        <x-input wire:model.defer="addItems.{{ $index }}.surname" class="block text-black w-full" type="text" autofocus />
                    </div>

                    <div wire:key="item-{{ $loop->index }}-number" class="ml-3">
                        <x-input wire:model.defer="addItems.{{ $index }}.jersey_number" class="block text-black w-full" type="text" autofocus />
                    </div>

                    @if(count($addItems) == 1)
                    <div>
                        <x-button type="button" wire:click.prevent="addMore">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </x-button>
                    </div>
                    @else
                    <div wire:key="item-{{ $loop->index }}-remove">
                        <x-button type="button" wire:click.prevent="removeItem({{ $index }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </x-button>
                    </div>
                    @endif
                </div>
                @endforeach

                @if(count($addItems) != 1)
                <div class="flex justify-center">
                    <div>
                        <x-button type="button" wire:click.prevent="addMore">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </x-button>
                    </div>
                </div>
                @endif

                <div class="flex justify-between mt-4 gap-5 text-center">
                    <div class="self-center">
                        Total: &#8369;{{ number_format($totalAmount, 2) }}
                    </div>
                </div>

                <div class="flex justify-center mt-4 gap-5 pb-5">
                    <div>
                        <x-button type="button" wire:click.prevent="closeCartModal" class="bg-red-500 text-2xl py-2 font-bold px-3 xl:px-12">
                            {{ __('Close') }}
                        </x-button>
                    </div>

                    <div>
                        <x-button class="bg-custom-violet text-xl xl:text-2xl py-3 font-bold xl:py-2 px-3 xl:px-6">
                            {{ __('Add to Cart') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    @else
    <div class="">
        <div>
            <h2 class="font-semibold text-l leading-tight ">
                {{ __('Variant already in Cart') }}
            </h2>
        </div>
        
        <div class="flex justify-center mt-4 gap-5 pb-5">
            <div>
                <x-button type="button" wire:click.prevent="closeCartModal" class="bg-red-500 text-2xl py-2 font-bold px-3 xl:px-12">
                    {{ __('Close') }}
                </x-button>
            </div>

            <div>
                <a href="{{ route('checkout.index', [json_encode($this->user_cart)])  }}">
                    <x-button class="bg-custom-violet text-xl xl:text-2xl py-3 font-bold xl:py-2 px-3 xl:px-6">
                        {{ __('Checkout') }}
                    </x-button>
                </a>
            </div>
        </div>
    </div>
    @endif
    
</div>
