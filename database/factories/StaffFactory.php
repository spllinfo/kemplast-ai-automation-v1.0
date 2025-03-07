<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'branch_id' => Branch::factory(),
            'staff_code' => 'STF' . fake()->unique()->numberBetween(1000, 9999),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'alt_phone' => fake()->optional()->phoneNumber(),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'marital_status' => fake()->randomElement(['single', 'married', 'divorced', 'widowed']),
            'designation' => fake()->jobTitle(),
            'department' => fake()->randomElement(['Production', 'Quality', 'Maintenance', 'HR', 'Finance', 'Sales']),
            'profile_picture' => null,
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-20 years'),
            'joining_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'confirmation_date' => fake()->optional()->dateTimeBetween('-4 years', 'now'),
            'termination_date' => null,
            'experience_years' => fake()->numberBetween(0, 20),
            'skills' => json_encode(fake()->randomElements(['PHP', 'Laravel', 'JavaScript', 'MySQL', 'Git', 'Docker'], 3)),
            'certifications' => json_encode(fake()->randomElements(['AWS Certified', 'PMP', 'Six Sigma', 'ISO 9001'], 2)),
            'employee_type' => fake()->randomElement(['permanent', 'contract', 'temporary']),
            'work_shift' => fake()->randomElement(['morning', 'afternoon', 'night']),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'pincode' => fake()->postcode(),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'emergency_contact_relation' => fake()->randomElement(['Spouse', 'Parent', 'Sibling', 'Friend']),
            'emergency_contact_address' => fake()->address(),
            'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'medical_conditions' => fake()->optional()->sentence(),
            'allergies' => fake()->optional()->sentence(),
            'health_insurance_provider' => fake()->optional()->company(),
            'health_insurance_id' => fake()->optional()->bothify('INS-####-####'),
            'basic_salary' => fake()->numberBetween(20000, 100000),
            'hourly_rate' => fake()->optional()->numberBetween(100, 500),
            'bank_name' => fake()->company(),
            'bank_account_no' => fake()->numerify('############'),
            'ifsc_code' => fake()->regexify('[A-Z]{4}0[A-Z0-9]{6}'),
            'pan_number' => fake()->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'aadhar_number' => fake()->numerify('############'),
            'pf_number' => fake()->optional()->numerify('PF-####-####'),
            'esi_number' => fake()->optional()->numerify('ESI-####-####'),
            'documents' => json_encode([
                'pan_card' => fake()->url(),
                'aadhar_card' => fake()->url(),
                'bank_statement' => fake()->url(),
            ]),
            'last_background_check' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'last_medical_checkup' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'training_completed' => json_encode([
                'safety_training' => fake()->dateTimeBetween('-1 year', 'now'),
                'technical_training' => fake()->dateTimeBetween('-1 year', 'now'),
            ]),
            'status' => fake()->randomElement(['active', 'inactive', 'on_leave', 'terminated', 'suspended', 'probation']),
            'reporting_to' => null,
            'leave_balance' => fake()->numberBetween(0, 30),
            'performance_ratings' => json_encode([
                'last_review' => fake()->dateTimeBetween('-1 year', 'now'),
                'rating' => fake()->numberBetween(1, 5),
                'comments' => fake()->paragraph(),
            ]),
        ];
    }
}
