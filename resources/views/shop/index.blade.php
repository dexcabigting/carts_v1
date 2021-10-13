<div>
    <div class="pt-12 pb-6">
        <div class="max-w-5xl mx-auto">
            <div class=" shadow-2xl overflow-hidden sm:rounded-lg">
                <div class="flex flex-row items-center gap-5 p-5 bg-custom-blacki  overflow-x-auto"> 
                    <div class="text-white font-semibold text-xl ml-12">
                        Browse our products!
                    </div>

                    <!-- Search Bar -->
                    <div class="ml-8 col-span-2 lg:col-span-2 grid items-center align-center relative lg:w-96">
                        <x-input class="h-9 pr-10" type="search" wire:model="search" autofocus />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-indigo-300 absolute right-0" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-6">
        <div class="grid grid-cols-3 gap-5 max-w-5xl mx-auto">

                @forelse ($products as $product)
                <!-- Loop Content -->
                <div class="flex flex-col bg-custom-blacki p-5 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex-none m-auto p-5 bg-white shadow-2xl">    
                        <img class="h-40 w-40" src="{{ Storage::url('public/' . $product->product_variants->first()->front_view) }}" />
                    </div>
                    
                    <div class="flex flex-grow p-5 items-center">
                        <div class="">
                            <x-button disabled>                                   
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white hover:text-blue-500" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                            </x-button>
                        </div>

                        <div class="">
                            <x-button wire:click.prevent="openCartModal({{ $product->id }})">                                   
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white hover:text-custom-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </x-button>
                        </div>

                        <div class="font-semibold text-white text-2xl bg-custom-violet px-4 py-4 ">
                            &#8369;{{ $product->prd_price }}
                        </div>
                    </div>    
                    
                </div>
                @empty
                <div>
                    There are no results
                </div>  
                @endforelse
                
        </div>
    </div>

    <div class="pb-12 text-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="">
                {{ $products->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>