<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Discount;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'discount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
