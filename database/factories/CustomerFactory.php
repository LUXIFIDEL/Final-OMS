<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{User};
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $array = [0, 1];

        return [
            'user_id' => User::factory(),
            'gender' => $random = Arr::random($array),
            'birthdate' => now(),
            'cellphone_number' => $this->faker->unique()->randomDigit,
            'address' => $this->faker->address,
        ];
    }
}
