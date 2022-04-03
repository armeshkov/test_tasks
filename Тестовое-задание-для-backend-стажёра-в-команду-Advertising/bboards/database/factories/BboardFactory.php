<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bboard>
 */
class BboardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'photo1' => $this->faker->imageUrl(),
            'photo2' => $this->faker->imageUrl(),
            'photo3' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(),
        ];
    }
}
