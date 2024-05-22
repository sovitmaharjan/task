<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['m', 'f', 'o'];
        return [
            'name' => fake()->name(),
            'dob' => fake()->date(),
            'gender' => $gender[rand(0, 2)],
            'address' => fake()->address(),
            'first_release_year' => fake()->year(),
            'no_of_album_released' => fake()->numberBetween(1, 17),
        ];
    }
}
