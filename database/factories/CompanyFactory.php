<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo_src' => $this->faker->image(),
            'name' => $this->faker->company(),
            'code' => rand(10000000, 999999999),
            'adress' => $this->faker->address(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
