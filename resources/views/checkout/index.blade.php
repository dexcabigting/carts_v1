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

    <div class="pb-5">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-row gap-5">
                <div class="flex bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-custom-blacki shadow-2xl text-base text-black">
                        <div class>
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full " type="text" name="name" value="{{ Auth::user()->name }}" autofocus required />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="phone" :value="__('Phone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ Auth::user()->phone }}" required />
                        </div>


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
                                                Product Variant
                                            </th>
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

                                        @php($cartTotal = 0)
                                        @forelse($userCarts as $userCart)

                                        @foreach($userCart->cartItemSizes() as $key => $value)
                                        <tr>
                                            @if($loop->first)
                                            <td class="md:px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                        {{ $userCart->product_variant->product->prd_name }}: {{ $userCart->product_variant->prd_var_name }}
                                                        @php($price = $userCart->product_variant->product->prd_price)
                                                    </span>
                                                </div>
                                            </td>
                                            @else
                                            <td>

                                            </td>
                                            @endif

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
                                        @endforeach

                                        @if(!$loop->last)
                                        <tr>
                                            <td class="h-10 bg-gray-100" colspan="4">

                                            </td>
                                        </tr>
                                        @endif
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

                                            <td>

                                            </td>

                                            <td class="md:px-6 py-4 ">
                                                <div>
                                                    <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                        x{{ $cartQuantity }}
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
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <div>
                                                    <a href="{{ route('payment.index') }}">
                                                        <x-button type="button" class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white px-4 py-2 bg-custom-violet my-3">
                                                            {{ __('Place Order') }}
                                                        </x-button>
                                                    </a>
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
