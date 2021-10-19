<div>
    <div class="pt-12 pb-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    Checkout
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-row gap-5">
                <div class="flex bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                        {{ $userCart->product_variant->product->prd_name }} {{ $userCart->product_variant->prd_var_name }}
                        @php($cartTotal = 0)
                        @foreach($userCartItems as $key => $value)
                        <div class="text-base text-white">
                            {{ $key }} x{{ $value }} &#8369;{{ number_format($total = $value * $price, 2) }}
                            @php($cartTotal = $cartTotal + $total)
                        </div>
                        @endforeach
                        x{{ $cartQuantity }} &#8369;{{ number_format($cartTotal, 2) }}
                    </div>
                </div>

                <div class="flex-1 flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">
                                <table class="table-auto min-w-full divide-y divide-gray-200">
                                    <thead class="bg-custom-blacki">
                                        <tr>
                                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Size
                                            </th>
                                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quantity
                                            </th>
                                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="text-center md:px-6 py-4 whitespace-nowrap" colspan="3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $userCart->product_variant->product->prd_name }}: {{ $userCart->product_variant->prd_var_name }}
                                                </div>
                                            </td>
                                        <tr>
                                            @php($cartTotal = 0)
                                            @forelse($userCartItems as $key => $value)
                                        <tr>
                                            <td class="md:px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $key }}
                                                </div>
                                            </td>

                                            <td class="md:px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    x{{ $value }}
                                                </div>
                                            </td>

                                            <td class="md:px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    &#8369;{{ number_format($total = $value * $price, 2)}}
                                                    @php($cartTotal = $cartTotal + $total)
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="md:px-6 py-4 text-center" colspan="6">
                                                <div>
                                                    <span class=" text-2xl font-semibold text-gray-400 leading-tight">
                                                        {{ __('You have no carts!') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                        <tr>
                                            <td class="md:px-6 py-4">
                                                <div>
                                                    <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                        Total:
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="md:px-6 py-4 ">
                                                <div>
                                                    <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                        {{ $cartQuantity }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="md:px-6 py-4 ">
                                                <div>
                                                    <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                        &#8369;{{ number_format($cartTotal, 2) }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
