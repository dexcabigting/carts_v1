<div id="cart-modal" class="z-10 flex flex-wrap flex-row justify-items-center align-items-center fixed top-0 left-0 w-full h-full">
    <div class="py-12 fixed top-0 left-0 w-full h-full bg-gray-500 opacity-50">
    </div>

    <div class="m-auto z-20">
        <div class="flex flex-row gap-6">
            <div class="max-w-md mx-auto overflow-y-auto">
                <div class="bg-white shadow-sm rounded-lg border-2">
                    <div class="p-5 bg-white border-b border-gray-200">
                        @include('shop.carts.create-1')
                    </div>
                </div>
            </div>
            <div class="mx-auto">
                <div class="bg-white shadow-sm rounded-lg border-2">
                    <div class="p-5 bg-white border-b border-gray-200 overflow-y-auto overflow-x-auto">
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