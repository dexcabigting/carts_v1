<div class="">
    <div class="font-semibold text-2xl p-3 border-gray-200">
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
            @foreach($sizes->sizes->toArray() as $column => $value)
                @if($value > 0)
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
</div>
