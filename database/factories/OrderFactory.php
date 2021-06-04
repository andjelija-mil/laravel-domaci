<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productIds=Product::all()->pluck('id')->toArray();

        return [
            'fullName'=>$this->faker->name,
            'email'=>$this->faker->email,
            'address'=>$this->faker->address,
            'status'=>'Pending',
            'product_id'=>$productIds[array_rand($productIds)]
        ];
    }
}
