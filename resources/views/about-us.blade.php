<x-guest-layout>
<style>
  .pt-\[17\%\] {
    padding-top: 17%;
  }
  .mt-\[-10\%\] {
    margin-top: -10%;
  }
  .pt-\[56\.25\%\] {
    padding-top: 56.25%;
  }
</style>

<main class="relative container mx-auto bg-custom-black px-4">
<h1 class="font-bold text-5xl lg:text-9xl text-center text-custom-text my-12">ABOUT</h1>

  <div class="mt-[-20%] w-1/2 mx-auto">
    <div class="relative pt-[56.25%] overflow-hidden rounded-2xl">
      <img class="w-full h-full absolute inset-0 object-cover" src="https://www.insidehook.com/wp-content/uploads/2020/07/sacramento_kings_basketball_nba.jpg?fit=1200%2C800" alt="" />
    </div>
  </div>

  <article class="max-w-6xl mx-auto py-8">
    <h1 class="text-4xl text-center text-gray-100 font-bold">ABOUT EJ EZON SPORTSWEAR</h1>
    <h2 class="mt-2 text-sm text-center text-gray-100">Admin, 28 November 2021</h2>

    <p class="mt-6 text-gray-100">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare justo felis, nec lobortis augue luctus et. Sed nibh metus, posuere non elit nec, rutrum imperdiet justo. Cras ut nunc felis. Nunc rhoncus faucibus ultrices. Suspendisse ut consectetur nulla. Pellentesque mattis, ligula at pellentesque tempor, nisl elit porta lectus, eu bibendum arcu purus eget urna. Phasellus euismod at elit vel convallis. Nullam porttitor mauris risus, eget hendrerit nisl tincidunt vel. Phasellus at dolor dui. Aliquam commodo tellus dolor. Sed purus nunc, laoreet quis elementum at, elementum at nisl. Praesent ut rhoncus orci. Curabitur sit amet est non dolor porttitor facilisis. Nullam velit tortor, iaculis eget vehicula quis, sollicitudin id magna.</p>
    <div class="flex flex-col xl:flex-row justify-center items-center">
    <div class="my-8 mx-8">
    <h1 class="font-bold text-4xl text-gray-100 my-2">MAP</h1>
    <iframe class="w-full xl:w-auto rounded-xl border-2 border-custom-violet" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30806.147577682583!2d120.57393482316884!3d15.171056024225324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396eda488ee23c9%3A0x9256aeb695ad711d!2sEzon%20Sport%20Wear!5e0!3m2!1sen!2sph!4v1637363654842!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div>
    <h1 class="text-center xl:text-left text-white lg:text-4xl my-4 font-bold">
    <span class="text-2xl text-custom-violet my-2">Owner:</span> <br>{{ $admin->user->name }} <br><span class="text-2xl text-custom-violet my-2">Email:</span> <br>{{ $admin->user->email }}  <br><span class="text-2xl text-custom-violet my-2">Phone:</span> <br><span class="font-sans">{{ $admin->user->phone }}</span>
    </h1>
    <h1 class="text-center xl:text-left text-gray-100 lg:text-4xl font-bold">
      <span class="text-2xl text-custom-violet my-2">Address:</span> <br>{{ $admin->barangay }}, {{ Str::ucfirst(Str::lower($admin->city)) }}, {{ Str::ucfirst(Str::lower($admin->province)) }}, {{ $admin->region }}
    </h1>
  </div>

  <br>
  

    </div>
    <h1 class="font-bold text-4xl xl:text-8xl text-center text-custom-text my-12">
      Available Fabrics:
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    @foreach($fabrics as $fabric)
    <div class="">
            <div class="mx-4 my-4 bg-custom-gray rounded-lg shadow-lg p-12 flex flex-col justify-center items-center">
                <div class="text-center">
                    <p class="text-xl text-white font-bold mb-2"> {{ $fabric->fab_name }}</p>
                </div>
            </div>   
    </div>
    @endforeach
    </div>
   
   

<!-- ahello -->
  <div>
    <h1 class="font-bold text-4xl xl:text-8xl text-center text-custom-text my-12">
      Available Product Categories:
    </h1>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    @foreach($categories as $category)

    <div>
                <div class="mx-4 my-4 bg-custom-gray rounded-lg shadow-lg p-12 flex flex-col justify-center items-center">
                    <p class="text-xl text-white font-bold mb-2"> {{ $category->ctgr_name }}</p>
                </div>
      
    </div>
    @endforeach
  </div>
  </article>
</main>

        
      
    
   
</x-guest-layout>
