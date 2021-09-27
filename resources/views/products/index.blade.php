<div class="pt-12 pb-5">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-start">
                    <x-button wire:click="openCreateModal()">
                        {{ __('Add Product') }}
                    </x-button>
                </div>  
            </div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto grid grid-cols-3">
    @forelse ($products as $index => $product)
    <div class="mb-5 p-auto">
        <div class="mx-auto sm:px-5 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200">
                    <div class="bg-gray-400 w-auto h-auto sm:rounded-lg mb-5 p-5">
                        <img src="{{ Storage::url('public/' . $product->prd_image) }}?{{ rand() }}" />
                    </div>

                    <div>
                        Name: {{ $product->prd_name }}
                    </div>

                    <div>
                        Product description: {{ $product->prd_description }}
                    </div>

                    <div>
                        Product price: {{ $product->prd_price }}
                    </div>    

                    <div class="mt-5 flex gap-5">
                        <div>
                            <button wire:click="openEditModal( {{ $product->id }} )" type="button" class="p-2 bg-green-400 rounded-md border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Edit') }}
                                </span>
                            </button>
                        </div>

                        <div>
                            <button wire:click="openDeleteModal( {{ $product->id }} )" type="button" class="p-2 bg-red-500 rounded-md border border-transparent font-semibold text-xs text-white uppercase tracking-normal hover:bg-red-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Delete') }}
                                </span>
                            </button>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty

    @endforelse
</div>
<div class="pb-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4">
            {{ $products->onEachSide(5)->links() }}
        </div>
    </div>
</div>
