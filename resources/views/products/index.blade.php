<div class="h-screen pt-20 lg:pt-24 xl:pt-40 xl:pl-3 2xl:pl-44 w-full flex flex-col">
    <div class="flex items-center justify-center ml-12 md:ml-0">
        <div class="w-full">
            <div class="inline-flex">
                <div class="inline-flex mx-2 lg:ml-0 mb-4 p-4 bg-custom-blacki shadow-2xl overflow-x-auto">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex flex-row">
                    <div class="mx-1">
                        <x-button class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-sm 2xl:text-xl font-semibold text-white px-4 py-2 bg-custom-violet my-3" wire:click="openCreateModal()">
                            {{ __('Create Product') }}
                        </x-button>
                    </div>

                    @if($query != 'products')
                        <div wire:key="{{ $query }}" class="mx-1">
                            <button wire:click.prevent="restoreProducts" type="button" {{ (!$checkedProducts) ?  'disabled' : null }} class="px-4 py-2 my-3 bg-green-600 border border-transparent text-sm 2xl:text-xl font-semibold text-white hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedProducts) cursor-not-allowed @endif">
                                {{ __('Bulk Restore') }}
                                @if ($checkedProducts)
                                    ({{ count($checkedProducts) }})
                                @endif
                            </button>
                        </div>
                    @else
                        <div wire:key="{{ $query }}" class="mx-1">
                            <button wire:click.prevent="openDeleteModal(@json($this->checked_keys))" type="button" {{ (!$checkedProducts) ?  'disabled' : null }} class="rounded-sm hover:bg-red-900 hover:text-purple-100 text-sm 2xl:text-xl font-semibold text-white px-4 py-2 bg-red-600 my-3 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedProducts) cursor-not-allowed @endif">
                                {{ __('Bulk Delete') }}
                                @if ($checkedProducts)
                                    ({{ count($checkedProducts) }})
                                @endif
                            </button>
                        </div>
                    @endif
                    </div>

                    <!-- Products -->
                    <div class="xl:ml-0">
                        <div class="font-medium text-gray-100 py-4">
                            <div class="flex flex-col items-center justify-items-center lg:flex-row mx-2">
                                <div class="mx-2">
                                <x-label :value="__('Products')" class="text-gray-50 inline-block font-bold text-sm mx-1 xl:text-xl" />
                                </div>
                                <div class="inline-flex">
                                    <select wire:model="query" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                        <option value="products">
                                                <x-label :value="__('Products')" class="inline-block" />
                                        </option>

                                        <option value="deletedProducts">
                                            <x-label :value="__('Deleted Products')" class="inline-block" />
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Order By -->
                    <div class="px-4">
                        <div class="flex flex-col items-center justify-center lg:flex-row mx-2">
                            <div class="mx-2">
                            <x-label :value="__('Order by')" class="font-semibold text-gray-50 inline-block text-base -ml-2" />
                            </div>
                            <div>
                                <div class="flex md:flex-row flex-col">
                                <div>
                            <select wire:model="sortBy" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="prd_name">
                                    <x-label :value="__('Name')" class="inline-block" />
                                </option>

                                <option value="created_at">
                                    <x-label :value="__('Date Created')" class="inline-block" />
                                </option>
                            </select>

                            <select wire:model="orderBy" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                <option value="asc">
                                    <x-label :value="__('Ascending')" class="inline-block" />
                                </option>

                                <option value="desc">
                                    <x-label :value="__('Descending')" class="inline-block" />
                                </option>
                            </select>
                            </div>
                            <div>
                            <select wire:model="category" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                <option value="All" selected>
                                    <x-label value="Categories" class="inline-block" />
                                </option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    <x-label value="{{ $category->ctgr_name }}" class="inline-block" />
                                </option>
                                @endforeach
                            </select>

                            <select wire:model="fabric" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                <option value="All" selected>
                                    <x-label value="Fabrics" class="inline-block" />
                                </option>
                                @foreach($fabrics as $fabric)
                                <option value="{{ $fabric->id }}">
                                    <x-label value="{{ $fabric->fab_name }}" class="inline-block" />
                                </option>
                                @endforeach
                            </select>
                            </div>

                            </div>
                            </div>
                        </div>
                        </div>

                    </div>

                    <!-- Search Bar -->
                    <div class="hidden col-span-2 lg:col-span-2 md:grid items-center align-center relative lg:w-64">
                        <x-input class="h-9 pr-10" type="search" wire:model="search" autofocus />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-custom-violet absolute right-0" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Reset Filter -->
                    <div class="ml-2 align-center items-center flex  col-span-2">
                        <x-button title="Reset Filter" type="button" wire:click="resetFilter()">
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
</svg>
                        </x-button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="max-w-md lg:max-w-none lg:ml-0 ml-6 overflow-scroll ">
        <div class="flex flex-col">
            <div class="my-2 ">
                <div class="py-2">
                    <div class="shadow  sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200 border-4 border-gray-500">
                            <thead class="bg-custom-blacki ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 float-left">
                                        <div>
                                            <input type="checkbox" wire:model="selectAll" {{ (count($products) == 0) ?  'disabled' : null }} class="rounded border-gray-100 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Fabric
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Date Created
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-custom-text divide-y divide-gray-200">
                                @forelse ($products as $index => $product)
                                <tr>
                                    <td class="px-6 py-4" wire:key="product-{{ $loop->index }}">
                                        <div>
                                            <input type="checkbox" wire:model="checkedProducts.{{ $product->id }}" class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $products->firstItem() + $index }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if(!$product->trashed())
                                                    <img wire:key="{{ $loop->index }}-not-trashed" class="h-10 w-10 rounded-full" src="{{ Storage::url($product->product_variants->first()->front_view) }}" alt="">
                                                @else
                                                    <img wire:key="{{ $loop->index }}-trashed" class="h-10 w-10 rounded-full" src="{{ Storage::url($product->deleted_product_variants->first()->front_view) }}" alt="">    
                                                @endif                                  
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-100">
                                                    {{ $product->prd_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $product->category->ctgr_name }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $product->fabric->fab_name }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(!$product->trashed())
                                            <div class="text-sm font-medium text-gray-100">
                                                @php
                                                    $quantity = 0;
                                                @endphp
                                                @foreach($product->product_stocks as $product_stock)
                                                    @php
                                                        $quantity += $product_stock->quantity;
                                                    @endphp
                                                @endforeach
                                                x{{ $quantity }}
                                            </div>
                                        @else
                                            <div class="text-sm font-medium text-gray-100">
                                                @php
                                                    $quantity = 0;
                                                @endphp
                                                @foreach($product->deleted_product_stocks as $product_stock)
                                                    @php
                                                        $quantity += $product_stock->quantity;
                                                    @endphp
                                                @endforeach
                                                x{{ $quantity }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="flex px-6 py-4 whitespace-nowrap">
                                        @if(!$product->trashed())
                                            <div wire:key="{{ $loop->index }}-edit">
                                                <button wire:click.prevent="openEditModal({{ $product->id }})" type="button" class="p-2 bg-green-600  border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ __('Edit') }}
                                                    </span>
                                                </button>
                                            </div>

                                            <div wire:key="{{ $loop->index }}-delete">
                                                <button wire:click.prevent="openDeleteModal({{ $product->id }})" type="button" class="p-2 bg-red-600  border border-transparent font-semibold text-xs text-white uppercase tracking-normal hover:bg-red-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ __('Delete') }}
                                                    </span>
                                                </button>
                                            </div>
                                        @else
                                            <div wire:key="{{ $loop->index }}-restore">
                                                <button wire:click.prevent="restoreProduct({{ $product->id }})" class="p-2 bg-green-600 border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ __('Restore') }}
                                                    </span>
                                                </button>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $product->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 text-center w-full items-center" colspan="8">
                                        <div>
                                            <span class="font-semibold text-xl text-gray-100  leading-tight">
                                                {{ __('There are no matches!') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
                {{ $products->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener('exceptionAlert', event => {
        alert('An error occured! ' + event.detail.error);  
    });
</script>
