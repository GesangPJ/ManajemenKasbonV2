<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kasbon>
 */
class KasbonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,5),
            'jumlah' => fake()->randomNumber(6,true),
            'status_r' => 'belum',
            'status_b' => 'belum',
            'keterangan' =>fake()->sentence(15),
            'metode'=> 'CA',
        ];
    }

    public function transfer(): static
    {
        return $this->state(fn (array $attributes) => [
            'metode' => 'TF',
        ]);
    }
}
