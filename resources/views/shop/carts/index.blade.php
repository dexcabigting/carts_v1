<div>
    <div class="pt-12 pb-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                    Hello
                </div>
            </div>
        </div>
    </div>

    <div class="pb-6">
        <div class="grid grid-cols-2 auto-cols-auto gap-6 max-w-6xl mx-auto">
            <div>
                @forelse ($userCarts as $userCart)
                <div class="pb-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex gap-6 p-6 bg-white border-b border-gray-200 overflow-x-auto text-left">
                            <div class="flex-grow">
                                {{ $userCart->product->prd_name }}
                            </div>
                            <div class="flex-grow">
                                Quantity: {{ $userCart->quantity }}
                            </div>  
                            <div class="flex-grow">
                                Subtotal: {{ $userCart->subtotal }}
                            </div>
                            <div>
                                <x-button type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </x-button>
                            </div>
                            <div>
                                <x-button type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </x-button>
                            </div>                            
                        </div>
                    </div> 
                </div> 
                @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                        You have no carts!
                    </div>
                </div>
                @endforelse
            </div>

            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                        Hello
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>