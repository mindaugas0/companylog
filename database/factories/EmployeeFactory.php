<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_photo' => $this->faker->image(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthday' => $this->faker->date(),
            'details' => $this->faker->paragraph(3),
            'company_id' => rand(1, 30),
        ];
    }
}
