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
