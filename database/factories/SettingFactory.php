<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word,
            'value' => json_encode($this->faker->words(3)),
            'group' => $this->faker->randomElement(['general', 'security', 'email', 'ui', 'system']),
            'type' => $this->faker->randomElement(['string', 'boolean', 'integer', 'array', 'json']),
            'description' => $this->faker->sentence,
            'is_public' => $this->faker->boolean,
            'is_system' => $this->faker->boolean(20), // 20% chance of being a system setting
            'created_at' => $this->faker->dateTimeBetween('-1 year'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month')
        ];
    }

    /**
     * Configure the factory to create a system setting.
     */
    public function system(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_system' => true,
                'group' => 'system'
            ];
        });
    }

    /**
     * Configure the factory to create a public setting.
     */
    public function public(): self
    {
        return $this->state(function (array $attributes) {
            return ['is_public' => true];
        });
    }
}