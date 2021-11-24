<div class="h-screen">
    <div class="pt-12 pb-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row gap-5 p-6 bg-custom-blacki shadow-2xl overflow-x-auto">
                     <!-- Order By -->
                    <div class="px-4">
                        <div class="flex flex-col xl:flex-row text-sm font-medium text-gray-100 py-4">
                            <div class="w-1/3">
                                <x-label :value="__('Order by')" class="font-semibold text-gray-50 inline-block text-base 2xl:text-xl" />
                            </div>

                            <div class="flex flex-row">
                                <select wire:model="sortColumn" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="name">
                                        <x-label :value="__('Customer Name')" class="inline-block" />
                                    </option>

                                    <option value="invoice_number">
                                        <x-label :value="__('Invoice Number')" class="inline-block" />
                                    </option>

                                    <option value="created_at">
                                        <x-label :value="__('Date Created')" class="inline-block" />
                                    </option>
                                </select>

                                <select wire:model="sortDirection" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <option value="asc">
                                        <x-label :value="__('Ascending')" class="inline-block" />
                                    </option>

                                    <option value="desc">
                                        <x-label :value="__('Descending')" class="inline-block" />
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-span-2 lg:col-span-2 grid items-center align-center relative lg:w-64">
                        <x-input class="h-9 pr-10" type="search" wire:model="search" autofocus />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-custom-violet absolute right-0" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto">
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
                                        Invoice Number
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer Name
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
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->invoice_number }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->user->name }}
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
                                            <button wire:click="openViewModal({{ $order->id }})" type="button" class="p-2 bg-custom-violet hover:bg-purple-900 hover:text-purple-100 border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </span>
                                            </button>
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
                                                {{ __('There are no orders!') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                                <tr>
                                    <td class="md:px-6 py-4 text-center" colspan="4">
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
