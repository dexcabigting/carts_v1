<?php

namespace Tests\Livewire\Products;

use Livewire\Livewire;
use App\Http\Livewire\Products\ProductsIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\CategorySeeder;
use Database\Seeders\FabricSeeder;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\Product;
use App\Models\ProductVariant;

class Index extends TestCase
{
	use RefreshDatabase;

	public function test_select_all_products()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();

		$product = Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->create();

		Livewire::test(ProductsIndex::class)
			->set("selectAll", true)
			->assertSet("checkedProducts", [$product->id => true])
			->assertSet("checkedKeys", [$product->id]);
	}

	public function test_uncheck_selected_product()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();

		$products = Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->count(5)
			->create();
		$checkedProducts = $products
			->pluck("id")
			->map(fn ($item) => (string) $item)
			->flip()
			->map(fn ($item) => true);
		$checkedProducts->put(0, false);

		Livewire::test(ProductsIndex::class)
			->set("selectAll", true)
			->set("checkedProducts", $checkedProducts->toArray())
			->assertSet("selectAll", false)
			->assertSet("checkedProducts", $checkedProducts->filter()->toArray())
			->assertSet("checkedKeys", $checkedProducts->filter()->keys()->toArray());
	}

	public function test_filtered_products()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();
		$tshirt_id = Category::where("ctgr_name", "T-Shirt")->first()->id;

		$jersey_products = Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->create();
		$tshirt_products = Product::factory()
			->addCategory($tshirt_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(3), 'product_variants')
			->count(3)
			->create();

		Livewire::test(ProductsIndex::class, [ "category" => "$tshirt_id" ])
			->assertDontSee($jersey_products->prd_name)
			->assertSeeInOrder($tshirt_products->pluck("prd_name")->sort()->toArray());
	}

	public function test_open_delete_modal_to_bulk_delete()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();

		$products = Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->count(5)
			->create();

		Livewire::test(ProductsIndex::class)
			->set("selectAll", true)
			->call("openDeleteModal", $products->pluck("id")->toArray())
			->assertStatus(200);
	}

	public function test_open_delete_modal_to_delete_one_item()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();

		$product = Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->create();

		Livewire::test(ProductsIndex::class)
			->call("openDeleteModal", $product->id)
			->assertStatus(200);
	}

	public function test_cleanse()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();

		Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->count(10)
			->create();

		Livewire::test(ProductsIndex::class)
			->set("selectAll", true)
			->call("cleanse")
			->assertSet("selectAll", false)
			->assertSet("checkedProducts", []);
	}

	public function test_unset_checked_products()
	{
		[$jersey_id, $sportsmax_id] = $this->create_default_ids();

		$products = Product::factory()
			->addCategory($jersey_id)
			->addFabric($sportsmax_id)
			->has(ProductVariant::factory()->count(2), 'product_variants')
			->count(10)
			->create();
		$selectedProducts = $products
			->take(2)
			->pluck("id")
			->map(fn ($item) => (string) $item)
			->flip()
			->map(fn ($item) => true)
			->toArray();

		Livewire::test(ProductsIndex::class)
			->set("checkedProducts", $selectedProducts)
			->call("unsetCheckedProducts", array_keys($selectedProducts))
			->assertSet("checkedProducts", []);
	}

	private function create_default_ids() {
		return [$this->create_jersey_id(), $this->create_sportsmax_id()];
	}

	private function create_jersey_id() {
		(new CategorySeeder())->run();

		return Category::where("ctgr_name", "Jersey")->first()->id;
	}

	private function create_sportsmax_id() {
		(new FabricSeeder())->run();

		return Fabric::where("fab_name", "Sportsmax")->first()->id;
	}
}
