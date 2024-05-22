<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $artistId = Artist::inRandomOrder()->first()->id;
        $genre = ['rnb', 'country', 'classic', 'rock', 'jazz'];
        return [
            'artist_id' => $artistId,
            'title' => fake()->firstName(),
            'album_name' => fake()->firstName(),
            'genre' => $genre[rand(0, 4)],
        ];
    }
}
