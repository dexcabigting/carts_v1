<x-app-user-layout>

    <div class="pt-4 w-full flex justify-center items-center">
        <div class="max-w-3xl mx-auto sm:px-6 w-full mb-5 2xl:mt-24">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-custom-blacki border-gray-500 divide-y divide-gray-300">

                    <div class="pb-4">
                        <x-success-fail-message class="mb-4" />
                        <x-validation-errors class="mb-4" :errors="$errors" />

                        <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
                            {{ __('Credentials') }}
                        </h2>

                        <form method="POST" action="{{ route('profile.update-credentials') }}">
                            @method('PUT')
                            @csrf

                            <div class>
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full text-black" type="text" name="name" value="{{ Auth::user()->name }}" autofocus required />
                            </div>

                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ Auth::user()->phone }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                                    {{ __('Update Credentials') }}
                                </x-button>
                            </div>

                        </form>
                    </div>

                    <div>
                        @livewire('profile.profile-index-address')
                    </div>
                    
                    <div class="pt-4">
                        <h2 class="font-semibold text-xl text-gray-100 leading-tight mb-4">
                            {{ __('Password') }}
                        </h2>

                        <form method="POST" action="{{ route('profile.update-password') }}">
                            @method('PUT')
                            @csrf

                            <div class="mt-4">
                                <x-label for="current_password" :value="__('Current Password')" />
                                <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="new_password" :value="__('New Password')" />
                                <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="new_password_confirmation" :value="__('Confirm New Password')" />
                                <x-input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet my-3">
                                    {{ __('Update Password') }}
                                </x-button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var my_handlers = {
            fill_provinces: function() {
                var region_code = $("#region").val();
                $("#region-text").val($("#region").find(`option[value=${region_code}]`).html());
                $('#province').ph_locations('fetch_list', [{
                    "region_code": region_code
                }]);

            },
            fill_cities: function() {
                var province_code = $("#province").val();
                $("#province-text").val($("#province").find(`option[value=${province_code}]`).html());
                $('#city').ph_locations('fetch_list', [{
                    "province_code": province_code
                }]);
            },
            fill_barangays: function() {
                var city_code = $("#city").val();
                $("#city-text").val($("#city").find(`option[value=${city_code}]`).html());
                $('#barangay').ph_locations('fetch_list', [{
                    "city_code": city_code
                }]);
                // Automatically extract to barangay text because the user may thought that his/her barangay has already been selected.
                // const observer = new MutationObserver((children, observer) => {
                //     observer.disconnect();
                //     var selected_barangay_number = $("#barangay").val();
                //     var selected_barangay_name = $(`#barangay option[value=${selected_barangay_number}]`).html();
                //     $("#barangay-text").val(selected_barangay_name);
                // });
                // observer.observe(document.querySelector("#barangay"), {
                //     "childList": true
                // });
            },
            put_barangay: function() {
                var barangay_code = $("#barangay").val();
                $("#barangay-text").val($("#barangay").find(`option[value=${barangay_code}]`).html());
            }
        };

        function observe(location, label, nextLocation) {
            const observer = new MutationObserver((children, observer) => {
                observer.disconnect();
                $(location).prepend("<option value=\"label\">"+label+"</option>");
                $(location).val("label");
                $(nextLocation+" option").attr("selected", true);
                observe(location, label, nextLocation);
            });
            observer.observe(document.querySelector(location), {
                "childList": true
            });
        }

        $(function() {
            observe("#region", "Region", "#province");


            $('#region').on('change', my_handlers.fill_provinces);
            $('#province').on('change', my_handlers.fill_cities);
            $('#city').on('change', my_handlers.fill_barangays);
            $('#barangay').on('change', my_handlers.put_barangay);
            $('#region').ph_locations({
                'location_type': 'regions'
            });
            $('#province').ph_locations({
                'location_type': 'provinces'
            });
            $('#city').ph_locations({
                'location_type': 'cities'
            });
            $('#barangay').ph_locations({
                'location_type': 'barangays'
            });
            $('#region').ph_locations('fetch_list');
            // setTimeout(my_handlers.fill_provinces.bind($("#region")), 1000);
            // setTimeout(() => {
            //     $("#region").prepend("<option value=\"label\"t>Region</option>");
            //     $("#region").val("label");
            // }, 500);
        });
    </script>

    <script>
        window.addEventListener('loadRegions', function () {
            $('#region').ph_locations('fetch_list');
        });
    </script>
</x-app-user-layout>
