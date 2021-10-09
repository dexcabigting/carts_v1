<?php

namespace Tests\Livewire;

use Livewire\Livewire;
use App\Http\Livewire\Users\UsersIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use App\Models\User;

class Index extends TestCase
{
	use RefreshDatabase;

	public function test_user_select_all()
	{
		(new RoleSeeder())->run();

		$user = User::factory()->asCustomer()->create();

		Livewire::test(UsersIndex::class)
			->set("selectAll", true)
			->assertSet("checkedUsers", [$user->id => true]);
	}

	public function test_uncheck_selected_user()
	{
		(new RoleSeeder())->run();
		// (new UserSeeder())->run();

		$users = User::factory()->asCustomer()->count(10)->create();
		$checkedUsers = $users
			->pluck("id")
			->map(fn ($item) => (string) $item)
			->flip()
			->map(fn ($item) => true);
		$checkedUsers->put(0, false);

		Livewire::test(UsersIndex::class)
			->set("selectAll", true)
			->set("checkedUsers", $checkedUsers->toArray())
			->assertSet("selectAll", false)
			->assertSet("checkedUsers", $checkedUsers->filter()->toArray());
	}
}
