<div class="mx-auto">
    <div class="flex flex-col gap-5 p-5 align-middle inline-block ">
        <div class="relative bg-custom-blacki text-xl font-extrabold text-center text-white p-5 sm:rounded-lg">
            Order Details

            @if(auth()->user()->role_id == 1)
                <div class="absolute top-0 right-0">
                    <x-button class="m-3 hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="proofOfPaymentOrCustomerInfo()">
                        @if(!$proofOfPayment)
                            {{ __('Proof of Payment') }}
                        @else
                            {{ __('Customer Info') }}
                        @endif
                    </x-button>
                </div>
            @endif
        </div>

        <div class="flex flex-row gap-5">
            <div class="w-3/4 shadow overflow-hidden border-gray-200 sm:rounded-lg">
                <table class="min-w-full table-auto divide-y divide-gray-200">
                    <thead class="bg-custom-blacki">
                        <tr>
                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Products
                            </th>
                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Size
                            </th>
                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Surname
                            </th>
                            <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach($userOrder->order_variants as $userOrderVariant)
                        <tr>
                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $userOrderVariant->product_variant->product->prd_name. ': ' .$userOrderVariant->product_variant->prd_var_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    <ul>
                                        @foreach($userOrderVariant->order_items as $size)
                                            <li>{{ $size->size }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    <ul>
                                        @foreach($userOrderVariant->order_items as $surname)
                                            <li>{{ $surname->surname }}</li>
                                        @endforeach
                                    </ul>
                                </div>  
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    @php
                                        $amount = 0;
                                    @endphp
                                    <ul>
                                        @foreach($userOrderVariant->order_items as $price)
                                            <li>&#8369;{{ number_format($userOrderVariant->amount, 2) }}</li>
                                            @php
                                                $amount = $amount + $userOrderVariant->amount
                                            @endphp
                                        @endforeach
                                    </ul>
                                    @php
                                        $subtotal = $subtotal + $amount;
                                    @endphp
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            Quantity:
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap" colspan="3">
                                <div class="text-sm font-medium text-gray-900">
                                    x{{ $userOrder->order_items_count }}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            Subtotal:
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap text-right" colspan="3">
                                <div class="text-sm font-medium text-gray-900">
                                    &#8369;{{ number_format($subtotal, 2) }}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            Transaction Fee:
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap text-right" colspan="3">
                                <div class="text-sm font-medium text-gray-900">
                                    &#8369;{{ number_format($userOrder->transaction_fee, 2) }}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            Total:
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap text-right" colspan="3">
                                <div class="text-sm font-medium text-gray-900">
                                    &#8369;{{ number_format($subtotal + $userOrder->transaction_fee, 2) }}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            Status:
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="md:px-6 py-4 whitespace-nowrap text-right" colspan="3">
                                <div class="text-sm font-medium text-gray-900">
                                    <select wire:model="selectedStatus">
                                        @foreach($orderStatuses as $index => $orderStatus)
                                            <option value="{{ $orderStatus }}">
                                                {{ $orderStatus }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if(!$proofOfPayment)
            <div class="w-1/4 bg-white flex flex-col p-5 gap-2 rounded-lg text-black">
                <div class="">
                    <span class="font-semibold">Name:</span> {{ $userOrder->user->name }}
                </div>

                <div class="">
                    <span class="font-semibold">Email:</span> {{ $userOrder->user->email }}
                </div>

                <div class="">
                    <span class="font-semibold">Phone:</span> {{ $userOrder->user->phone }}
                </div>

                <div class="flex flex-row gap-1">
                    <div>
                        <span class="font-semibold">Address: </span>
                    </div>
                    <div>
                        Address: {{ $userOrder->user_address->home_address }}, {{ $userOrder->user_address->barangay }}, {{ ucwords($userOrder->user_address->city) }}, {{ $userOrder->user_address->province }}
                    </div>                                      
                </div>

                <div class="mt-2">
                    <span class="font-semibold">Payment Method:</span> 
                </div>

                <div class="mt-2">
                    <span class="font-semibold">Amount Paid:</span> &#8369;
                </div>
            </div>
            @else
            <div class="w-1/4">
                <img src="{{ Storage::url('public/' . $userOrder->payment_proof) }}" />
            </div>
            @endif
        </div>
        
        <div class="flex justify-center items-center gap-5"> 
            <div>
                <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="updateStatus()">
                    {{ __('Save') }}
                </x-button>
            </div>
            <div>
                <x-button class="hover:bg-red-400 hover:text-purple-100 text-XL font-semibold text-white px-4 py-2 bg-red-500" type="button" wire:click="closeViewModal()">
                    {{ __('Close') }}
                </x-button>
            </div>
        </div>
    </div>
</div>        
