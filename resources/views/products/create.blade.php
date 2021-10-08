<div class="py-5 overflow-y-auto">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex justify-around">
        <div>
            <h2 class="font-semibold text-l leading-tight mb-4">
                {{ __('Product Info') }}
            </h2>
        </div>
    </div>
    
    <form method="POST" wire:submit.prevent="store" enctype="multipart/form-data">
        @csrf

        <div class="overflow-y-auto px-5 h-96">
            <div class="flex flex-row divide-gray-200 gap-5">
                <div class="w-48">                
                    <div>
                        <x-label :value="__('Name')"/>
                        <x-input  wire:model.defer="form.prd_name" class="block mt-1 w-full text-black" type="text" value="{{ old('prd_name') }}" autofocus required />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Category')" />
                        <select wire:model="form.prd_category" class="border-gray-300 mt-1 text-black rounded-lg w-full">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                {{ $category->ctgr_name }}
                                </option>  
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Fabric')" />
                        <select wire:model="form.prd_fabric" class="border-gray-300 mt-1 text-black rounded-lg w-full">
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
                
                <div class="flex flex-row gap-5">
                    <div class="w-16">
                        <div>
                            <x-label for="2XS" :value="__('2XS')"/>
                            <x-input id="2XS" wire:model.defer="form.2XS" class="block mt-1 w-full text-black" type="text" value="{{ old('2XS') }}" autofocus />
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="XS" :value="__('XS')"/>
                            <x-input id="XS" wire:model.defer="form.XS" class="block mt-1 w-full text-black" type="text" value="{{ old('XS') }}" autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="S" :value="__('S')"/>
                            <x-input id="S" wire:model.defer="form.S" class="block mt-1 w-full text-black" type="text" value="{{ old('S') }}" autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="M" :value="__('M')"/>
                            <x-input id="M" wire:model.defer="form.M" class="block mt-1 w-full text-black" type="text" value="{{ old('M') }}" autofocus />
                        </div>
                    </div>

                    <div class="w-16">
                        <div>
                            <x-label for="L" :value="__('L')"/>
                            <x-input id="L" wire:model.defer="form.L" class="block mt-1 w-full text-black" type="text" value="{{ old('L') }}" autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="XL" :value="__('XL')"/>
                            <x-input id="XL" wire:model.defer="form.XL" class="block mt-1 w-full text-black" type="text" value="{{ old('XL') }}" autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="2XL" :value="__('2XL')"/>
                            <x-input id="2XL" wire:model.defer="form.2XL" class="block mt-1 w-full text-black" type="text" value="{{ old('2XL') }}" autofocus />
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-96 mt-4">
                <div class="flex justify-around">
                    <div>
                        <h2 class="font-semibold text-l  leading-tight mb-4">
                            {{ __('Variants') }}
                        </h2>
                    </div>
                </div>

                @foreach($addVariants as $index => $addVariant)
                    <div class="flex items-center gap-5 pb-3">
                        <div class="">    
                            <x-label :value="__('Variant Name')"/>
                            <x-input wire:model.defer="addVariants.{{ $index }}.prd_var_name" class="block w-full text-black" type="text" autofocus />
                        </div>

                        <div class="w-2/4">
                            <div class="">
                                <x-label :value="__('Front View')"/>
                                <input type="file" wire:model.defer="addVariants.{{ $index }}.front_view" />
                                <div wire:loading wire:target="addVariants.{{ $index }}.front_view">Uploading...</div>
                            </div>

                            <div class="">   
                                <x-label :value="__('Back View')"/> 
                                <input type="file" wire:model.defer="addVariants.{{ $index }}.back_view" />
                                <div wire:loading wire:target="addVariants.{{ $index }}.back_view">Uploading...</div>
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

        <div class="flex justify-center px-5 mt-4 gap-5 items-center">
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                    {{ __('Add Product') }}
                </x-button>
            </div>  
            <div>
                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-custom-violet my-3" type="button" wire:click="closeCreateModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </form>
</div>

