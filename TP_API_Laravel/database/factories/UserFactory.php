<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('motDePasse'), // password
            'role_id' => 2,
            'remember_token' => Str::random(10),
        ];
    }

 //   /**
 //    * Indicate that the model's email address should be unverified.
 //    */
 //   public function unverified(): static
 //   {
 //       return $this->state(fn (array $attributes) => [
 //           'email_verified_at' => null,
 //       ]);
 //   }
}
