<div class="h-screen mx-auto px-10 ">
    <div class="flex flex-col">
    <div class="pt-12 pb-6">
        <div class="mx-auto">
            <div class="bg-custom-blacki overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki shadow-2xl text-6xl font-extrabold text-center text-gray-300 font-extraboldoverflow-x-auto">
                    Categories
                </div>
                <div class="flex flex-row gap-5 p-5">
                    <form wire:submit.prevent="addCategory">
                        <div class="block  w-full">
                        <div class="text-gray-900">
                            <x-label  for="name" :value="__('Name')"/>
                            <x-input wire:model="form.name" id="name" class="block mt-1 w-full " type="text" name="name" value="{{ old('name') }}" autofocus required />
                        </div>

                        <div class="w-96">
                            <x-label for="email" :value="__('Description')" />
                            <x-input wire:model="form.description" id="email" class="block mt-1 w-full" type="text" name="email" value="{{ old('description') }}" required />
                        </div>
                        </div>
                        <div class="">
                            <x-button type="submit" class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-12 py-4 bg-custom-violet my-3">
                                {{ __('Create Category') }}
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
                                        Name
                                    </th>
                                    <th scope="col" class="md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($categories as $index => $category)
                                <tr>
                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                   {{ $category->ctgr_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="md:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $category->ctgr_description }}
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
                                                {{ __('There are no categories!') }}
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
</div>