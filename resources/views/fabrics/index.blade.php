<div class="h-screen lg:ml-40 lg:mt-12">
    <div class="pt-12 pb-6">
        <div class="mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    Fabrics
                </div>
                <div class="flex flex-row gap-5 p-5">
                    <form wire:submit.prevent="addFabric">
                        <div class="text-gray-900">
                            <x-label  for="name" :value="__('Name')"/>
                            <x-input wire:model="form.name" id="name" class="block mt-1 w-full " type="text" name="name" value="{{ old('name') }}" autofocus required />
                        </div>

                        <div class="">
                            <x-label for="email" :value="__('Description')" />
                            <x-input wire:model="form.description" id="email" class="block mt-1 w-full" type="text" name="email" value="{{ old('description') }}" required />
                        </div>

                        <div class="">
                            <x-button type="submit" class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-12 py-4 bg-custom-violet my-3">
                                {{ __('Create Fabric') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto">
        <div class="flex flex-col">
            <div class="my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">
                        <table class="table-auto min-w-full divide-y divide-gray-200">
                            <thead class="bg-custom-blacki">
                                <tr>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fabric Name
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($fabrics as $index => $fabric)
                                <tr>
                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                {{ $fabric->fab_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $fabric->fab_description }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-row">
                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Edit
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Delete
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="md:px-6 py-4 text-center" colspan="6">
                                        <div>
                                            <span class=" text-2xl font-semibold text-gray-400 leading-tight">
                                                {{ __('There are no fabrics!') }}
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
</div>
