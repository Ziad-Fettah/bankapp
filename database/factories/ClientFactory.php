<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'prenom' => $this->faker->name(),
            'nom' => $this->faker->name(),
            'adresse' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
