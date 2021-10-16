<?php

namespace Tests\Livewire\Users;

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
			->assertSet("checkedUsers", [$user->id => true])
			->assertSet("checkedKeys", [$user->id]);
	}

	public function test_uncheck_selected_user()
	{
		(new RoleSeeder())->run();

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
			->assertSet("checkedUsers", $checkedUsers->filter()->toArray())
			->assertSet("checkedKeys", $checkedUsers->filter()->keys()->toArray());
	}

	public function test_unset_selected_users()
	{
		(new RoleSeeder())->run();

		$users = User::factory()->asCustomer()->count(10)->create();
		$retainedUserID = $users->get(0)->id;
		$userIDstoRemove = $users
			->pluck("id")
			->filter(fn ($item) => $item != $retainedUserID);

		Livewire::test(UsersIndex::class)
			->set("selectAll", true)
			->call("unsetCheckedUsers", $userIDstoRemove->toArray())
			->assertSet("selectAll", false)
			->assertSet("checkedUsers", [$retainedUserID => true]);
	}

	public function test_cleanse()
	{
		(new RoleSeeder())->run();

		$users = User::factory()->asCustomer()->count(10)->create();
		$checkedUsers = $users
			->pluck("id")
			->map(fn ($item) => (string) $item)
			->flip()
			->map(fn ($item) => true);

		Livewire::test(UsersIndex::class)
			->set("selectAll", true)
			->assertSet("checkedUsers", $checkedUsers->toArray())
			->assertSet("checkedKeys", $checkedUsers->keys()->toArray())
			->call("cleanse")
			->assertSet("selectAll", false)
			->assertSet("checkedUsers", [])
			->assertSet("checkedKeys", []);
	}

	public function test_users_property()
	{
		(new RoleSeeder())->run();

		$users = User::factory()->asCustomer()->count(10)->create();

		// Used `assertSeeInOrder` because the instances are not the same.
		Livewire::test(UsersIndex::class)
			->assertSeeInOrder($users->pluck("Name")->sort()->toArray());
	}

	public function test_checked_keys()
	{
		(new RoleSeeder())->run();

		$users = User::factory()->asCustomer()->count(10)->create();

		Livewire::test(UsersIndex::class)
			->set("selectAll", true)
			->assertSet("checkedKeys", $users->pluck("id")->toArray());
	}
}
