<div class="h-auto pt-24 lg:pl-16 2xl:pl-56 w-full flex flex-col">
     <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="inline-flex">
                <div class="flex flex-row gap-2 ml-5 lg:ml-0 px-14 xl:px-6 p-7 2xl:px-20 bg-custom-blacki shadow-2xl overflow-x-auto">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex flex-row">
                    <div class="mx-1">
                        <x-button class="rounded-sm hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white px-4 py-2 bg-custom-violet my-3" wire:click="openCreateModal()">
                            {{ __('Create Fabric') }}
                        </x-button>
                    </div>

                    <div class="mx-1">
                        <button wire:click.prevent="openDeleteModal(@json($this->checked_keys))" type="button" {{ (!$checkedFabrics) ?  'disabled' : null }} class="rounded-sm hover:bg-red-900 hover:text-purple-100 text-xl font-semibold text-white px-4 py-2 bg-red-600 my-3 disabled:opacity-25 transition ease-in-out duration-150 @if (!$checkedFabrics) cursor-not-allowed @endif">
                            {{ __('Bulk Delete') }}
                            @if ($checkedFabrics)
                                ({{ count($checkedFabrics) }})
                            @endif
                        </button>
                    </div>
                    </div>
                    <!-- Order By -->
                    
                    <div class="px-4">
                        <div class="flex flex-col items-center justify-items-center lg:flex-row mx-2">
                            <div class="mb-4">
                                <x-label :value="__('Order by')" class="font-semibold text-gray-50 inline-block text-base 2xl:text-xl" />
                            </div>

                            <div class="flex flex-row">
                                <select wire:model="sortColumn" class="text-sm font-medium bg-custom-black text-white rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="fab_name">
                                        <x-label :value="__('Name')" class="inline-block" />
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

                    
                    </div>
                    <!-- Search Bar -->
                    <div class="hidden col-span-2 lg:col-span-2 md:grid items-center align-center relative lg:w-64">
                        <x-input class="h-9 pr-10" type="search" wire:model="search" autofocus />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 fill-current text-custom-violet absolute right-0" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:max-w-5xl 2xl:max-w-6xl max-w-md lg:ml-0 ml-4">
        <div class="flex flex-col">
            <div class="my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200 border-4 border-gray-500">
                            <thead class="bg-custom-blacki ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 float-left">
                                        <div>
                                            <input type="checkbox" wire:model="selectAll" {{ (count($fabrics) == 0) ?  'disabled' : null }} class="rounded border-gray-100 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                        Description
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
                                @forelse ($fabrics as $index => $fabric)
                                <tr class="">
                                    <td class="px-6 py-4" wire:key="fabric-{{ $loop->index }}">
                                        <div>
                                            <input type="checkbox" wire:model="checkedFabrics.{{ $fabric->id }}" class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $fabrics->firstItem() + $index }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-100">
                                                {{ $fabric->fab_name }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $fabric->fab_description }}
                                        </div>
                                    </td>

                                    <td class="flex px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <button wire:click.prevent="openEditModal({{ $fabric->id }})" type="button" class="p-2 bg-green-600  border border-transparent font-semibold text-xs text-white uppercase tracking-wide hover:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </span>
                                            </button>
                                        </div>

                                        <div>
                                            <button wire:click.prevent="openDeleteModal({{ $fabric->id }})" type="button" class="p-2 bg-red-600  border border-transparent font-semibold text-xs text-white uppercase tracking-normal hover:bg-red-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Delete') }}
                                                </span>
                                            </button>
                                        </div>
                                    </td>

                                    <td class="break-words px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">
                                            {{ $fabric->created_at }}
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

    <div class="pb-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
                {{ $fabrics->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
