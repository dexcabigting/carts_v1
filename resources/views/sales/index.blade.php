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
</div>
