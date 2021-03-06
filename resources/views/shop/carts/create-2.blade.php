<div class="flex flex-col-reverse md:flex-col gap-5 p-5 h-full overflow-y-auto">
    @foreach($variants as $variantTest)
    <div>
    <div class="flex justify-left">
        <div>
            <h2 class="font-semibold text-3xl leading-tight ">
                {{ $product->prd_name }}: {{ $variantTest->prd_var_name }}
            </h2>
        </div>
    </div>

    <div class="">
        {{ $variants->links() }}
    </div>
    </div>
    <div>
    <div class="flex flex-col xl:flex-row gap-5">
        <div class="bg-white m-auto rounded-lg relative h-70 w-70">
            <img class="bg-black py-2 px-2 h-10 w-10 absolute top-0 right-0 rounded-tr-md" src="img/Group 12.svg">
            <div class="flex-none m-auto p-10 bg-white shadow-2xl rounded-md">
                <img class="h-70 w-70" src="{{ Storage::url('public/' . $variantTest->front_view) }}" />
            </div>
            <div class="text-black text-2xl font-bold absolute bottom-2 left-2">
                Front View
            </div>
        </div>

        <div class="bg-white m-auto rounded-lg relative h-70 w-70">
            <img class="bg-black py-2 px-2 h-10 w-10 absolute top-0 right-0 rounded-tr-md" src="img/Group 12.svg">
            <div class="flex-none m-auto p-10 bg-white shadow-2xl rounded-md">
                <img class="h-70 w-70" src="{{ Storage::url('public/' . $variantTest->back_view) }}" />
            </div>
            <div class="text-black text-2xl font-bold absolute bottom-2 left-2">
                Back View
            </div>
        </div>
    </div>
    </div>
    <div class="overflow-clip border-gray-200 text-2xl">
        {{ $product->prd_description }}
    </div>

    <div class="overflow-clip border-gray-200 text-xl">
        Made with 100% {{ $product->fabric->fab_name }}
    </div>

    <div class="overflow-clip border-gray-200 text-xl">
        {{ $product->fabric->fab_description }}
    </div>

    <div class="border-gray-200">
        <div class="text-2xl">
            Available sizes:
        </div>

        <div class="flex flex-row flex-wrap text-center">
            @foreach($variantTest->product_stock->sizes->toArray() as $column => $value)
                @if($value > 0)
                <div class="p-2 border border-gray-300 rounded-lg w-20">
                    {{ $column }}
                    <div class="justify p-2 border border-gray-300 rounded-lg">
                        {{ $value }}
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endforeach
</div>
