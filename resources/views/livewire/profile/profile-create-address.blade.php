<div id="create-modal" class="z-10 flex flex-wrap flex-row justify-items-center align-items-center fixed top-0 left-0 w-full h-full">
    <div class="fixed top-0 left-0 w-full h-full bg-gray-500 opacity-75">

    </div>

    @if(auth()->user()->role_id == 1)
        <div class="m-auto z-20">
            <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
                <div class="bg-custom-blacki shadow-sm rounded-lg border-2 border-transparent">
                    <div class="p-6 bg-custom-blacki ">
                        @include('profile.create-address-admin')
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="m-auto z-20">
            <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
                <div class="bg-custom-blacki shadow-sm rounded-lg border-2 border-transparent">
                    <div class="p-6 bg-custom-blacki ">
                       @include('profile.create-address-user')
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    window.addEventListener('createModalDisplayNone', event => {
        document.getElementById("create-modal").style.display = "none";
    });
</script>
