<div class="h-screen w-full">
    <div class="pt-12 pb-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-5 p-6 bg-custom-blacki shadow-2xl overflow-x-auto">
                    <!-- Filter By -->
                    <div class="flex flex-row">
                        <div class="px-4">
                            <div class="flex flex-col xl:flex-row text-sm font-medium text-gray-100 py-4">
                                <div class="w-1/3">
                                    <x-label :value="__('Filter by')" class="font-semibold text-gray-50 inline-block text-base 2xl:text-xl" />
                                </div>

                                <div class="flex flex-row">
                                    <div>
                                        <!-- Category Filter -->
                                        <select wire:model="categoryId" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                            <option value="%%">
                                                    <x-label :value="__('Category')" class="inline-block" />
                                            </option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category['id'] }}">
                                                    <x-label value="{{ $category['ctgr_name'] }}" class="inline-block" />
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <!-- Fabric Filter -->
                                        <select wire:model="fabricId" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                            <option value="%%">
                                                    <x-label :value="__('Fabric')" class="inline-block" />
                                            </option>
                                            @foreach($fabrics as $fabric)
                                                <option value="{{ $fabric['id'] }}">
                                                    <x-label value="{{ $fabric['fab_name'] }}" class="inline-block" />
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <!-- Product Filter -->
                                        <select wire:model="productId" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                            <option value="%%">
                                                    <x-label :value="__('Product')" class="inline-block" />
                                            </option>
                                            @foreach($products as $product)
                                                <option value="{{ $product['id'] }}">
                                                    <x-label value="{{ $product['prd_name'] }}" class="inline-block" />
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                                
                                </div>
                            </div>
                        </div>

                        <!-- Order By -->
                        <div class="px-4">
                            <div class="flex flex-col xl:flex-row text-sm font-medium text-gray-100 py-4">
                                <div class="w-1/3">
                                    <x-label :value="__('Order by')" class="font-semibold text-gray-50 inline-block text-base 2xl:text-xl" />
                                </div>

                                <div class="flex flex-row">
                                    <div>
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
                        </div>

                        <!-- Reset Filter Button -->
                        <div>
                            <x-button type="button" wire:click="resetFilter()" class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500">
                                {{ __('Reset Filter') }}
                            </x-button>
                        </div>
                    </div>

                    <div class="flex flex-row text-sm font-medium text-gray-100">
                        <div>
                            <x-label :value="__('Start Date')" class="inline-block" />

                            <input class="bg-white text-black" wire:model="startDate" type="date" min="2021-01-01">
                        </div>

                        <div>
                            <x-label :value="__('End Date')" class="inline-block" />

                            <input class="bg-white text-black" wire:model="endDate" type="date">
                        </div>
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
                                        Product
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Variant
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fabric
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date Ordered
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $totalAmount = 0;
                                @endphp

                                @forelse($sales as $index => $sale)
                                <tr>
                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $sales->firstItem() + $index }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $sale->product_variant->product->prd_name }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $sale->product_variant->prd_var_name }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $sale->product_variant->product->category->ctgr_name }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $sale->product_variant->product->fabric->fab_name }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            x{{ $sale->quantity }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            &#8369;{{ number_format($sale->amount, 2) }}

                                            @php
                                                $totalAmount = $totalAmount + $sale->amount;
                                            @endphp
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($sale->earliest->toFormattedDateString() == $sale->latest->toFormattedDateString())
                                                {{ $sale->earliest->toFormattedDateString() }}
                                            @else
                                                {{ $sale->earliest->toFormattedDateString() }} to {{ $sale->latest->toFormattedDateString() }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="md:px-6 py-4 text-center" colspan="8">
                                        <div>
                                            <span class=" text-2xl font-semibold text-gray-400 leading-tight">
                                                {{ __('There are no sales!') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                                <tr>
                                    <td class="md:px-6 py-4 text-center" colspan="5">
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
                                                &#8369;{{ number_format($totalAmount, 2) }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 text-center" colspan="1">
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
                {{ $sales->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>