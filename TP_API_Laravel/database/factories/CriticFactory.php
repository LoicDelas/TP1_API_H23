<?php

namespace Database\Factories;

use App\Models\Critic;
use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Critic>
 */
class CriticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $memberUser_id = User::where('role_id', 2)->inRandomOrder()->first()->id;
        //$filmDejaCritiques = Critic::where('user_id', $user_id)->pluck('film_id');

        return [
            'user_id' => $memberUser_id,
            //'film_id' => Film::whereNotIn('id', $filmDejaCritiques)->inRandomOrder()->first()->id,
            'film_id' => Film::inRandomOrder()->first()->id,
            'score' => fake()->randomFloat(1, 0.0, 99.9),
            'comment' => fake()->boolean(70) ? fake()->realText() : null
        ];
    }
}
