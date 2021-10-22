<div class="h-screen">
    <div class="pt-12 pb-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    My Carts
                    @foreach ( $checkedCarts as $items)
                    {{ $items }}
                    @endforeach
                </div>


                <div class="">

                    <a href="{{ route('checkout.index', json_encode($this->checked_keys)) }}">
                        <button type="button" {{ (!$checkedCarts) ?  'disabled' : null }} class=" rounded-sm hover:bg-red-900 hover:text-purple-100 text-xl font-semibold text-white px-4 py-2 bg-red-600 my-3 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedCarts) cursor-not-allowed @endif">
                            {{ __('Bulk Checkout') }}
                            @if ($checkedCarts)
                            ({{ count($checkedCarts) }})
                            @endif
                        </button>
                    </a>
                </div>

                <div class="text-medium text-white">

                </div>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col">
            <div class="my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200">
                            <thead class="bg-custom-blacki">
                                <tr>
                                    <th scope="col" class="md:px-2 py-3 float-left">
                                        <div class="px-4">
                                            <input type="checkbox" wire:model="selectAll" {{ (count($userCarts) == 0) ?  'disabled' : null }} class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No.
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php($totalAmount = 0)
                                @forelse($userCarts as $index => $userCart)
                                <tr>
                                    <td class="md:px-6 py-4" wire:key="userCart-{{ $userCart->index }}">
                                        <div>
                                            <input type="checkbox" wire:model="checkedCarts.{{ $userCart->id }}" class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $userCarts->firstItem() + $index }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $userCart->product_variant->product->prd_name }}: {{ $userCart->product_variant->prd_var_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            x{{ $userCart->cart_items_count }}
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            &#8369;{{ number_format( $amount = ($userCart->cart_items_count) * ($userCart->product_variant->product->prd_price), 2) }}
                                            @php($totalAmount = $totalAmount + $amount)
                                        </div>
                                    </td>

                                    <td class="flex md:px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <a href="{{ route('checkout.index', [json_encode($userCart->id)])  }}">
                                                <button type="button" class="p-2 bg-custom-violet hover:bg-purple-900 hover:text-purple-100 border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </a>
                                        </div>
                                        <div>
                                            <button wire:click.prevent="openEditCartModal({{ $userCart->id }})" type="button" class="p-2 bg-green-600  border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                        <div>
                                            <button wire:click.prevent="openDeleteCartModal({{ $userCart->id }})" type="button" class="p-2 bg-red-600  border border-transparent font-semibold text-xs text-white uppercase tracking-normal hover:bg-red-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>

                                                </span>
                                            </button>
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
                                    <td class="md:px-6 py-4 text-center">
                                    </td>

                                    <td class="md:px-6 py-4 text-right" colspan="3">
                                        <div>
                                            <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                Total:
                                            </span>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 text-center">
                                        <div>
                                            <span class="font-semibold text-xl text-gray-800 leading-tight">
                                                &#8369;{{ number_format($totalAmount, 2) }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 text-center">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-end">
                    <button wire:click.prevent="openDeleteCartModal(@json($this->checked_keys))" type="button" {{ (!$checkedCarts) ?  'disabled' : null }} class="rounded-sm hover:bg-red-900 hover:text-purple-100 text-xl font-semibold text-white mx-2 px-4 py-2 bg-red-600 my-3 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedCarts) cursor-not-allowed @endif">
                        {{ __('Bulk Delete') }}
                        @if ($checkedCarts)
                        ({{ count($checkedCarts) }})
                        @endif
                    </button>
                    <button  wire:click.prevent="openDeleteCartModal(@json($this->checked_keys))" type="button" {{ (!$checkedCarts) ?  'disabled' : null }} class="opacity-40 rounded-sm hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white px-6 py-2 bg-custom-violet my-3 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedCarts) cursor-not-allowed @endif">
                       Check Out
                    </button>
                </div>
    </div>

    <div class="pb-12">
        <div class="max-w-2xl mx-auto sm:md:px-6 lg:px-8">
            <div class="mt-6">
                {{ $userCarts->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
