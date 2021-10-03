<div class="">
    <div class="font-bold text-2xl p-3 border-gray-200">    
        {{ $product->prd_name }}
    </div>

    <div class="p-3 border-gray-200 shadow-2xl rounded-lg"> 
        <div id="model-{{ sha1($product->prd_name) }}" class="h-80 w-80">
            
        </div>     

        <script type="module">
            render3d("model-{{ sha1($product->prd_name) }}", "{{ Storage::url('public/' . $product->prd_3d) }}");
        </script>
    </div>

    <div class="truncate p-3 border-gray-200">    
        {{ $product->prd_description }}
    </div>

    <div class="p-3 border-gray-200">    
        Available sizes:
            <div class="flex flex-row flex-wrap text-center">
                @foreach($product->product_stock->sizes->toArray() as $column => $value)
                    @if($value > 10)
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