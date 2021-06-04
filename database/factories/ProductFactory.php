<?php

namespace Database\Factories;

use App\Models\Category;
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
        $categoryIds=Category::all()->pluck('id')->toArray();
        return [
            'name'=>$this->faker->unique()->word,
            'description'=>null,
            'price'=>$this->faker->numberBetween(0,100),
            'category_id'=>$categoryIds[array_rand($categoryIds)]
        ];
    }
}
