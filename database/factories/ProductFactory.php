<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayValues = ['book', 'ebook', 'newspaper'];

        return [
            'type' => $arrayValues[rand(0,2)],
            'description' => $this->faker->text(),
            'image_url' => $this->faker->imageUrl()
        ];
    }
}
