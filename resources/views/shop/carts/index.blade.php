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
                        <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                            {{ $userCart->id }}
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