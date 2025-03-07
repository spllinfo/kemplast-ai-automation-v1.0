<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ProductionBatch;
use App\Models\ProductionStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreakdownFactory extends Factory
{
    public function definition(): array
    {
        $breakdownableType = fake()->randomElement([ProductionBatch::class, ProductionStage::class]);
        $breakdownable = $breakdownableType::factory()->create();
        $reportedBy = User::factory();
        $resolvedBy = fake()->boolean(70) ? User::factory() : null;
        $resolvedAt = $resolvedBy ? fake()->dateTimeBetween('-1 month', 'now') : null;

        return [
            'breakdown_code' => 'BD' . fake()->unique()->numberBetween(1000, 9999),
            'breakdownable_type' => $breakdownableType,
            'breakdownable_id' => $breakdownable->id,
            'description' => fake()->sentence(),
            'severity' => fake()->randomElement(['low', 'medium', 'high', 'critical']),
            'status' => $resolvedBy ? 'resolved' : fake()->randomElement(['reported', 'in_progress']),
            'resolution' => $resolvedBy ? fake()->paragraph() : null,
            'reported_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'resolved_at' => $resolvedAt,
            'reported_by' => $reportedBy,
            'resolved_by' => $resolvedBy,
            'metadata' => [
                'affected_components' => fake()->randomElements(['motor', 'belt', 'sensor', 'control panel'], fake()->numberBetween(1, 3)),
                'impact_level' => fake()->randomElement(['minimal', 'moderate', 'significant', 'severe']),
                'downtime_minutes' => fake()->numberBetween(5, 480),
                'maintenance_required' => fake()->boolean(80),
                'preventive_measures' => fake()->optional()->paragraph(),
            ],
        ];
    }

    public function reported(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'reported',
            'resolution' => null,
            'resolved_at' => null,
            'resolved_by' => null,
        ]);
    }

    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'resolution' => null,
            'resolved_at' => null,
            'resolved_by' => null,
        ]);
    }

    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'resolution' => fake()->paragraph(),
            'resolved_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'resolved_by' => User::factory(),
        ]);
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'closed',
            'resolution' => fake()->paragraph(),
            'resolved_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'resolved_by' => User::factory(),
        ]);
    }

    public function critical(): static
    {
        return $this->state(fn (array $attributes) => [
            'severity' => 'critical',
        ]);
    }

    public function high(): static
    {
        return $this->state(fn (array $attributes) => [
            'severity' => 'high',
        ]);
    }

    public function medium(): static
    {
        return $this->state(fn (array $attributes) => [
            'severity' => 'medium',
        ]);
    }

    public function low(): static
    {
        return $this->state(fn (array $attributes) => [
            'severity' => 'low',
        ]);
    }

    public function forBatch(): static
    {
        return $this->state(fn (array $attributes) => [
            'breakdownable_type' => ProductionBatch::class,
            'breakdownable_id' => ProductionBatch::factory(),
        ]);
    }

    public function forStage(): static
    {
        return $this->state(fn (array $attributes) => [
            'breakdownable_type' => ProductionStage::class,
            'breakdownable_id' => ProductionStage::factory(),
        ]);
    }
}
