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
        return [
            'name' => 'Test Product'.' '.$this->faker->numberBetween(1, 9999),
            'description' => $this->faker->text(100),
            'price' => random_int(10, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
