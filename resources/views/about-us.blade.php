<x-guest-layout>
  <div>
    <h1 class="text-white">
      {{ $admin->user->name }} {{ $admin->user->email }} {{ $admin->user->phone }}
    </h1>
    <h1 class="text-white">
      {{ $admin->barangay }}, {{ Str::ucfirst(Str::lower($admin->city)) }}, {{ Str::ucfirst(Str::lower($admin->province)) }}, {{ $admin->region }}
    </h1>
  </div>

  <br>
  <div>
    <h1 class="text-white">
      Available Fabrics:
    </h1>
    <div>
      @foreach($fabrics as $fabric)
        <h1 class="text-white">
          {{ $fabric->fab_name }}
        </h1>
      @endforeach
    </div>
  </div>

  <br>
  <div>
    <h1 class="text-white">
      Available Product Categories:
    </h1>
    <div>
      @foreach($categories as $category)
        <h1 class="text-white">
          {{ $category->ctgr_name }}
        </h1>
      @endforeach
    </div>
  </div>
   
</x-guest-layout>
