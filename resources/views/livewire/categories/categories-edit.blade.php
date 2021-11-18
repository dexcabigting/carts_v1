<div id="edit-modal" class="z-10 flex flex-wrap flex-row justify-items-center align-items-center fixed top-0 left-0 w-full h-full">
    <div class="fixed top-0 left-0 w-full h-full bg-gray-500 opacity-75">

    </div>

    <div class="m-auto z-20">
            <div class="text-white mx-auto">
                <div class="bg-white shadow-sm rounded-lg border-4 border-gray-500">
                    <div class="bg-custom-blacki border-b border-gray-200">
                        @include('categories.edit')
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    window.addEventListener('editModalDisplayNone', event => {
        document.getElementById("edit-modal").style.display = "none";
    });
</script>
