<x-guest-layout>
    <x-auth-card>
        <div class="px-12">
            <section class="w-full flex justify-center items-center my-24 flex-col">
                <h1 class="font-semibold  text-7xl md:text-9xl text-custom-blacki my-4">REGISTER</h1>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="w-full max-w-lg" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-label class="text-xl text-custom-violet  " for="name" :value="__('Name')" />

                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label class="text-xl text-custom-violet  " for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Phone -->
                    <div class="mt-4">
                        <x-label class="text-xl text-custom-violet  " for="phone" :value="__('Phone')" />

                        <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-label for="region" :value="__('Region')" />
                        <select id="region">
                            <option>Region</option>
                        </select>
                        <x-input id="region-text" type="hidden" name="region" :value="old('region')" />
                    </div>
                    <div>
                        <x-label for="province" :value="__('Province')" />
                        <select id="province">
                            <option>
                                Province
                            </option>
                        </select>
                        <x-input id="province-text" type="hidden" name="province" :value="old('province')" />
                    </div>
                    <div>
                        <x-label for="city" :value="__('City')" />

                        <select id="city">
                            <option>City</option>
                        </select>
                        <x-input id="city-text" type="hidden" name="city" :value="old('city')" />
                    </div>
                    <div>
                        <x-label for="barangay" :value="__('Barangay')" />
                        <select name="barangay" id="barangay">
                            <option>Barangay</option>
                        </select>
                        <x-input id="barangay-text" type="hidden" name="barangay" :value="old('barangay')" />
                    </div>
                    <div class="mt-4">
                        <x-label class="text-xl text-custom-violet  " for="home_address" :value="__('Home Address')" />

                        <x-input id="home_address" class="block mt-1 w-full" type="text" name="home_address" :value="old('home_address')" required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label class="text-xl text-custom-violet  " for="password" :value="__('Password')" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label class="text-xl text-custom-violet  " for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex items-center flex-col justify-center ">
                        <div>
                            <x-button class="md:mt-4 mt-12 uppercase hover:bg-purple-900 hover:text-purple-100 text-3xl font-semibold text-white px-32 md:px-44 py-6 my-6 w-full bg-custom-violet">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                        <div>
                            <a class="underline text-xl text-gray-600 hover:text-purple-200" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </x-auth-card>

    <script type="text/javascript">
        var my_handlers = {
            fill_provinces: function() {
                var region_code = $(this).val();
                $("#region-text").val($(this).find(`option[value=${region_code}]`).html());
                $('#province').ph_locations('fetch_list', [{
                    "region_code": region_code
                }]);

            },
            fill_cities: function() {
                var province_code = $(this).val();
                $("#province-text").val($(this).find(`option[value=${province_code}]`).html());
                $('#city').ph_locations('fetch_list', [{
                    "province_code": province_code
                }]);
            },
            fill_barangays: function() {
                var city_code = $(this).val();
                $("#city-text").val($(this).find(`option[value=${city_code}]`).html());
                $('#barangay').ph_locations('fetch_list', [{
                    "city_code": city_code
                }]);
                // Automatically extract to barangay text because the user may thought that his/her barangay has already been selected.
                const observer = new MutationObserver((children, observer) => {
                    observer.disconnect();
                    var selected_barangay_number = $("#barangay").val();
                    var selected_barangay_name = $(`#barangay option[value=${selected_barangay_number}]`).html();
                    $("#barangay-text").val(selected_barangay_name);
                });
                observer.observe(document.querySelector("#barangay"), {
                    "childList": true
                });
            },
            put_barangay: function() {
                var barangay_code = $(this).val();
                $("#barangay-text").val($(this).find(`option[value=${barangay_code}]`).html());
            }
        };
        $(function() {

            const observer = new MutationObserver((children, observer) => {
                observer.disconnect();
                $("#region").prepend("<option value=\"label\"t>Region</option>");
                $("#region").val("label");
            });
            observer.observe(document.querySelector("#region"), {
                "childList": true
            });
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
</x-guest-layout>
