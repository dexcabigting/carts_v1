<div class="max-w-7xl p-5">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex flex-col bg-custom-blacki justify-center items-center">
        <div>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('User Credentials') }} {{ $form['verify_email'] }}
            </h2>
        </div>

        <form class="bg-custom-blacki" wire:submit.prevent="store(Object.fromEntries(new FormData($event.target)))">
            @csrf
            <div class="flex flex-row gap-5">
                <div class="flex flex-col gap-5">
                    <div class="text-gray-900">
                        <x-label  for="name" :value="__('Name')"/>
                        <x-input wire:model="form.name" id="name" class="block mt-1 w-full text-black" type="text" name="name" value="{{ old('name') }}" autofocus required />
                    </div>

                    <div class="">
                        <x-label for="email" :value="__('Email')" />
                        <x-input wire:model="form.email" id="email" class="block mt-1 w-full text-black" type="email" name="email" value="{{ old('email') }}" required />
                    </div>

                    <div class="">
                        <x-label for="phone" :value="__('Phone')" />
                        <x-input wire:model="form.phone" id="phone" class="block mt-1 w-full text-black" type="text" name="phone" value="{{ old('phone') }}" required />
                    </div>

                    <div class="">
                        <x-label for="password" :value="__('Password')" />
                        <x-input wire:model="form.password" id="password" class="block mt-1 w-full text-black"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>

                    <div class="">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-input wire:model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full text-black"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>

                    <div class="flex flex-row gap-5">
                        <div class="w-1/2">
                            <x-label :value="__('Role')" />
                            @foreach($roles as $role)
                                <div wire:key="{{ $loop->index }}-role">
                                    <input wire:model="form.role" type="radio" value="{{ $role['id'] }}" required/>
                                    <span>{{ $role['role'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="w-1/2">
                            <x-label :value="__('Verify Email?')" />
                            @foreach($yesOrNo as $option)
                                <div wire:key="{{ $loop->index }}-option">
                                    <input wire:model="form.verify_email" type="radio" value="{{ $option }}" required/>
                                    <span>{{ $option }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>  
                </div>

                <div>
                    <div>
                        <x-label class="text-xl mb-4 text-white" :value="__('Home Address')" />

                        <x-input id="home_address" class="block mt-1 w-full text-black" type="text" name="create_home_address" placeholder="ex. Street Apartment no." />
                    </div>

                    <!-- Address -->
                    <div class="block md:flex fle-row">
                        <div class="mt-4 ">
                            <x-label for="create_region" :value="__('Region')" />
                            <select class="text-black rounded-lg lg:pr-16 pr-4 w-full" id="create_region">
                                <option selected>
                                    Region
                                </option>
                            </select>
                            <x-input id="create_region-text" name="create_region" type="hidden" />
                        </div>

                        <div class="mt-4 md:ml-4">
                            <x-label for="create_province" :value="__('Home Address')" />
                            <select class="text-black rounded-lg md:pr-20 w-full md:w-auto" id="create_province">
                                <option>
                                    <h1 class="px-12">Province</h1>
                                </option>
                            </select>
                            <x-input id="create_province-text" name="create_province" type="hidden" />
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <x-label for="create_city" :value="__('City')" />
                        <select class="text-black rounded-lg w-full" id="create_city">
                            <option>
                                City
                            </option>
                        </select>
                        <x-input id="create_city-text" name="create_city" type="hidden" />
                    </div>

                    <div class="mt-4">
                        <x-label for="create_barangay" :value="__('Barangay')"  />
                        <select class="text-black rounded-lg w-full" id="create_barangay">
                            <option>
                                Barangay
                            </option>
                        </select>
                        <x-input id="create_barangay-text" name="create_barangay" type="hidden" />
                    </div>

                    <div class="mt-4">
                        <x-label :value="__('Set as Default')"  />
                            <input type="radio" name="is_main_address" value="1" checked/>
                            <label>Yes</label><br>
                            <input type="radio" name="is_main_address" value="0" />
                            <label >No</label><br>
                    </div>
                </div>
            </div>

             <div class="flex gap-5 justify-center">
                <div>
                    <x-button class="hover:bg-purple-900 hover:text-purple-100 text-xl font-semibold text-white w-full px-4 py-2 bg-custom-violet">
                        {{ __('Create User') }}
                    </x-button>
                </div>
                
                <div>
                    <x-button wire:click.prevent="closeCreateModal()" type="button" class="bg-red-500 text-gray-100 text-xl font-bold px-4 py-2">
                        {{ __('Close') }}
                    </x-button>
                </div>  
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var my_handlers = {
        fill_provinces: function() {
            var region_code = $(this).val();
            $("#create_region-text").val($(this).find(`option[value=${region_code}]`).html());
            $('#create_province').ph_locations('fetch_list', [{
                "region_code": region_code
            }]);

        },
        fill_cities: function() {
            var province_code = $(this).val();
            $("#create_province-text").val($(this).find(`option[value=${province_code}]`).html());
            $('#create_city').ph_locations('fetch_list', [{
                "province_code": province_code
            }]);
        },
        fill_barangays: function() {
            var city_code = $(this).val();
            $("#create_city-text").val($(this).find(`option[value=${city_code}]`).html());
            $('#create_barangay').ph_locations('fetch_list', [{
                "city_code": city_code
            }]);
            // Automatically extract to create_barangay text because the user may thought that his/her create_barangay has already been selected.
            const observer = new MutationObserver((children, observer) => {
                observer.disconnect();
                var selected_barangay_number = $("#create_barangay").val();
                var selected_barangay_name = $(`#create_barangay option[value=${selected_barangay_number}]`).html();
                $("#create_barangay-text").val(selected_barangay_name);
            });
            observer.observe(document.querySelector("#create_barangay"), {
                "childList": true
            });
        },
        put_barangay: function() {
            var barangay_code = $(this).val();
            $("#create_barangay-text").val($(this).find(`option[value=${barangay_code}]`).html());
        }
    };
    $(function() {

        const observer = new MutationObserver((children, observer) => {
            observer.disconnect();
            $("#create_region").prepend("<option value=\"label\"t>Region</option>");
            $("#create_region").val("label");
            // const options = $("#create_region > option");
            // for (const i = 0; i < 

        });
        observer.observe(document.querySelector("#create_region"), {
            "childList": true
        });
        $('#create_region').on('change', my_handlers.fill_provinces);
        $('#create_province').on('change', my_handlers.fill_cities);
        $('#create_city').on('change', my_handlers.fill_barangays);
        $('#create_barangay').on('change', my_handlers.put_barangay);
        $('#create_region').ph_locations({
            'location_type': 'regions'
        });
        $('#create_province').ph_locations({
            'location_type': 'provinces'
        });
        $('#create_city').ph_locations({
            'location_type': 'cities'
        });
        $('#create_barangay').ph_locations({
            'location_type': 'barangays'
        });
        $('#create_region').ph_locations('fetch_list');

    });
</script>
    
