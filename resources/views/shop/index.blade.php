<div>
    <div class="pt-12 pb-5">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row gap-5 p-6 bg-white border-b border-gray-200 overflow-x-auto">
                    
                    Browse our products!

                </div>
            </div>
        </div>
    </div>

    <div class="pt-12 pb-5">
        <div class="grid grid-cols-3 gap-5 max-w-6xl mx-auto">

                @forelse ($products as $product)
                <!-- Loop Content -->
                <div class="bg-white h-60 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-row gap-5 p-6 bg-white border-b border-gray-200 overflow-x-auto">
                        
                        {{ $product->prd_name }}

                    </div>
                    
                </div>
                @empty
                <div>
                    There are no results
                </div>  
                @endforelse
                
        </div>
    </div>
</div>