<?php

namespace Database\Factories;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShiftFactory extends Factory
{
    protected $model = Shift::class;

    public function definition(): array
    {
        $shifts = [
            'Morning' => ['06:00:00', '14:00:00'],
            'Afternoon' => ['14:00:00', '22:00:00'],
            'Night' => ['22:00:00', '06:00:00']
        ];

        $shiftName = fake()->randomElement(array_keys($shifts));
        $shiftTimes = $shifts[$shiftName];

        return [
            'name' => $shiftName . ' Shift',
            'code' => substr($shiftName, 0, 1) . fake()->numberBetween(100, 999),
            'start_time' => $shiftTimes[0],
            'end_time' => $shiftTimes[1],
            'break_duration' => 60, // minutes
            'capacity' => fake()->numberBetween(10, 30),
            'supervisor_id' => null, // This should be set in the seeder
            'status' => fake()->boolean(90),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}