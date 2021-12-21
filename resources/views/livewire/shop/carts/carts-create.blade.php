<div id="cart-modal" class="z-10 flex flex-wrap flex-row justify-items-center align-items-center absolute top-0 left-0 w-full h-full">
    <div class="py-12 fixed top-0 left-0 w-full h-full bg-gray-500 opacity-50">
    </div>

    <div class="p-5 m-auto z-20">
        <div class="flex flex-row gap-5">
            <div class="text-white w-1/3">
                <div class="flex flex-col gap-5">
                    <div class="bg-white shadow-sm rounded-lg border-4 border-gray-500">                   
                        <div class="bg-custom-blacki border-b border-gray-200">
                            @include('shop.carts.create-1')
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg border-4 border-gray-500">                   
                        <div class="bg-custom-blacki border-b border-gray-200">
                            @livewire('shop.carts.carts-comment-index', ['variantId' => $selectVariant])
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-white w-2/3">
                <div class="bg-white shadow-sm rounded-lg border-4 border-gray-500">
                    <div class="bg-custom-blacki border-b border-gray-200">
                        @include('shop.carts.create-2')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('cartModalDisplayNone', event => {
        document.getElementById("cart-modal").style.display = "none";
    });
</script>
