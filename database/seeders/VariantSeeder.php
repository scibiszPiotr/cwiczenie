<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variant::factory()->count(rand(9,60))->has(Attribute::factory()->count(rand(3,20)))->create();
    }
}
