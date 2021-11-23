<div class="h-screen">
    <div class="pt-12 pb-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    My Orders
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col">
            <div class="my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200">
                            <thead class="bg-custom-blacki">
                                <tr>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No.
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Products
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Amount
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date Ordered
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $total = 0;
                                @endphp
                                @forelse($orders as $index => $order)
                                <tr>
                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $orders->firstItem() + $index }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <ul>
                                                        @foreach($order->order_variants as $order_variant)
                                                            <li>
                                                                {{ $order_variant->product_variant->product->prd_name. ': ' .$order_variant->product_variant->prd_var_name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            x{{ $order->order_items_count }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            @php
                                                $amount = 0
                                            @endphp
                                                
                                            @foreach($order->order_variants as $order_variant)
                                                @php
                                                    $amount = $amount + $order_variant->variant_total()
                                                @endphp
                                            @endforeach

                                            &#8369;{{ number_format($amount = $amount + $order->transaction_fee, 2) }}
                                            @php
                                                $total = $total + $amount
                                            @endphp
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ Str::ucfirst($order->status) }}
                                        </div>
                                    </td>

                                    <td class="flex md:px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <a href="">
                                                <button type="button" class="p-2 bg-custom-violet hover:bg-purple-900 hover:text-purple-100 border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="md:px-6 py-4 text-center" colspan="6">
                                        <div>
                                            <span class=" text-2xl font-semibold text-gray-400 leading-tight">
                                                {{ __('You have no orders!') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                                <tr>
                                    <td class="md:px-6 py-4 text-center" colspan="2">
                                    </td>

                                    <td class="md:px-6 py-4 text-right">
                                        <div>
                                            <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                Total: 
                                            </span>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 text-left">
                                        <div>
                                            <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                &#8369;{{ number_format($total, 2) }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 text-center" colspan="3">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-2xl mx-auto sm:md:px-6 lg:px-8">
            <div class="mt-6">
                {{ $orders->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
