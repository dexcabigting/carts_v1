<tr>
    <td class="md:px-6 py-4" wire:key="userCart-{{ $userCart->index }}">

    </td>

    <td class="md:px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-500">
            {{ $userCarts->firstItem() + $index }}
        </div>
    </td>

    <td class="md:px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">

            <div class="">
                <div class="text-sm font-medium text-gray-500">
                    {{ $userCart->product_variant->product->prd_name }}: {{ $userCart->product_variant->prd_var_name }}
                </div>
            </div>
        </div>
    </td>

    <td class="md:px-6 py-4 whitespace-nowrap text-center">
        <div class="text-sm font-medium text-gray-500">
                Out of Stock
        </div>
    </td>

    <td class="md:px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-500">
            &#8369;{{ number_format( $amount = ($userCart->cart_items_count) * ($userCart->product_variant->product->prd_price), 2) }}
            @php($totalAmount = $totalAmount + $amount)
        </div>
    </td>

    <td class="flex md:px-6 py-4 whitespace-nowrap">
        
    </td>
</tr>
