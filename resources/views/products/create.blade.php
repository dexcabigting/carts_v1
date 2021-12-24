<div class="py-5 w-auto overflow-y-auto">
    <div class="px-5">
        <x-success-fail-message/>
        <x-validation-errors :errors="$errors" />
    </div>
    
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        @csrf

        <div class="overflow-y-auto px-5 h-96">
            <div class="flex flex-row divide-x-4 divide-gray-600 gap-5">
                <div class="w-48">
                    <div class="flex justify-around">
                        <div>
                            <h2 class="font-semibold text-l leading-tight mb-4">
                                {{ __('Product Info') }}
                            </h2>
                        </div>
                    </div>       

                    <div>
                        <x-label :value="__('Name')"/>
                        <x-input  wire:model.defer="form.prd_name" class="block mt-1 w-full text-black" type="text" value="{{ old('prd_name') }}" autofocus required />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Category')" />
                        <select wire:model="form.category_id" class="border-gray-300 mt-1 text-black rounded-lg w-full">
                            <option value="">
                                Category
                            </option>  
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                {{ $category->ctgr_name }}
                                </option>  
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Fabric')" />
                        <select wire:model="form.fabric_id" class="border-gray-300 mt-1 text-black rounded-lg w-full">
                            <option value="">
                                Fabric
                            </option>    
                            @foreach($fabrics as $fabric)
                                <option value="{{ $fabric->id }}">
                                    {{ $fabric->fab_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label for="prd_description" :value="__('Description')" />
                        <x-input wire:model.defer="form.prd_description" id="prd_description" class="block mt-1 w-full text-black" type="text" value="{{ old('prd_description') }}" required />
                    </div>

                    <div class="mt-4">
                        <x-label for="prd_price" :value="__('Price')" />
                        <x-input  id="prd_price" wire:model.defer="form.prd_price" type="text" class="block mt-1 w-full text-black"/>
                    </div>
                </div>
                
                <div class="pl-5">
                    <div class="">
                        <div class="flex justify-around">
                            <div>
                                <h2 class="font-semibold text-l  leading-tight mb-4">
                                    {{ __('Variants') }}
                                </h2>
                            </div>
                        </div>

                        @foreach($addVariants as $index => $addVariant)
                            <div wire:key="{{ $loop->index }}-variant-number" class="flex gap-5 pb-3">
                                <div wire:key="{{ $loop->index }}-variant-name">    
                                    <x-label :value="__('Variant')"/>
                                    <x-input wire:model.defer="addVariants.{{ $index }}.prd_var_name" class="block mt-1 w-full text-black" type="text" autofocus />
                                </div>

                                <div wire:key="{{ $loop->index }}-images" class="w-2/4">
                                    <div class="">
                                        <x-label :value="__('Front View')"/>
                                        <input type="file" wire:model.defer="addVariants.{{ $index }}.front_view" id="front-{{ $imageID }}" />
                                        <div wire:loading wire:target="addVariants.{{ $index }}.front_view">Uploading...</div>
                                    </div>

                                    <div class="">   
                                        <x-label :value="__('Back View')"/> 
                                        <input type="file" wire:model.defer="addVariants.{{ $index }}.back_view" id="back-{{ $imageID }}" />
                                        <div wire:loading wire:target="addVariants.{{ $index }}.back_view">Uploading...</div>
                                    </div>
                                </div>

                                <div wire:key="{{ $loop->index }}-sizes" class="flex flex-row gap-5">
                                    <div wire:key="{{ $loop->index }}-2xs">
                                        <x-label for="2XS" :value="__('2XS')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.2XS" class="block mt-1 w-14 text-black" type="text" value="{{ old('2XS') }}" autofocus />
                                    </div>
                                    
                                    <div wire:key="{{ $loop->index }}-xs">
                                        <x-label for="XS" :value="__('XS')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.XS" class="block mt-1 w-14 text-black" type="text" value="{{ old('XS') }}" autofocus />
                                    </div>

                                    <div wire:key="{{ $loop->index }}-s">
                                        <x-label for="S" :value="__('S')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.S" class="block mt-1 w-14 text-black" type="text" value="{{ old('S') }}" autofocus />
                                    </div>

                                    <div wire:key="{{ $loop->index }}-m">
                                        <x-label for="M" :value="__('M')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.M" class="block mt-1 w-14 text-black" type="text" value="{{ old('M') }}" autofocus />
                                    </div>
                                
                                    <div wire:key="{{ $loop->index }}-l">
                                        <x-label for="L" :value="__('L')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.L" class="block mt-1 w-14 text-black" type="text" value="{{ old('L') }}" autofocus />
                                    </div>

                                    <div wire:key="{{ $loop->index }}-xl">
                                        <x-label for="XL" :value="__('XL')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.XL" class="block mt-1 w-14 text-black" type="text" value="{{ old('XL') }}" autofocus />
                                    </div>

                                    <div wire:key="{{ $loop->index }}-2xl">
                                        <x-label for="2XL" :value="__('2XL')"/>
                                        <x-input wire:model.defer="addVariants.{{ $index }}.2XL" class="block mt-1 w-14 text-black" type="text" value="{{ old('2XL') }}" autofocus />
                                    </div>        
                                </div>

                                @if(count($addVariants) == 1) 
                                    <div>
                                        <x-button type="button" wire:click.prevent="addMore">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </x-button>
                                    </div>
                                @else 
                                    <div>
                                        <x-button type="button" wire:click.prevent="removeVariant({{ $index }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </x-button>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        @if(count($addVariants) != 1)
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
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center px-5 mt-4 gap-5 items-center">
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                    {{ __('Add Product') }}
                </x-button>
            </div>  
            <div>
                <x-button type="button" wire:click.prevent="closeCreateModal" class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>
