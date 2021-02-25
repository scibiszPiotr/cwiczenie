<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(300)->has(Variant::factory()->count(3)->has(Attribute::factory()->count(3)))->create();
    }
}
