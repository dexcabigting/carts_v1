<div class="h-full">
    <div class="pt-12 pb-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 overflow-x-auto">
                    Checkout
                </div>
            </div>
        </div>
    </div>

    <div class="pb-5">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-5">
                <!-- Checkout Details Table -->
                @include('checkout.index-2')

                <!-- Checkout Form -->
                @include('checkout.index-1')
            </div>
        </div>
    </div>
</div>
