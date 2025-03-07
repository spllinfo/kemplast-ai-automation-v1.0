<?php

namespace Database\Seeders;

use App\Models\JobPart;
use App\Models\Part;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class JobPartSeeder extends Seeder
{
    public function run(): void
    {
        // Get all parts
        $parts = Part::with('customer')->get();

        // Create job parts based on existing parts
        foreach ($parts as $part) {
            // Create 1-3 job parts for each part
            $numJobs = fake()->numberBetween(1, 3);
            
            for ($i = 1; $i <= $numJobs; $i++) {
                JobPart::create([
                    'job_unique_code' => 'JOB' . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                    'job_part_unique_code' => 'JP' . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                    'job_part_name' => $part->part_name,
                    'job_part_model' => $part->part_model,
                    'job_part_customer_name' => $part->customer->company_name,
                    'hsn_no' => $part->hsn_no,
                    'job_part_length' => $part->part_length,
                    'job_part_width' => $part->part_width,
                    'job_part_height' => $part->part_height,
                    'job_part_thickness' => $part->part_thickness,
                    'job_part_ld_ratio' => $part->part_ld_ratio,
                    'job_part_lld_ratio' => $part->part_lld_ratio,
                    'job_part_hd_ratio' => $part->part_hd_ratio,
                    'job_part_rd_ratio' => $part->part_rd_ratio,
                    'job_part_no_ups' => $part->part_no_ups,
                    'job_part_weight' => $part->part_weight,
                    'job_part_no_sealing_type' => $part->part_no_sealing_type,
                    'job_printing_status' => $part->printing_status,
                    'job_printing_colour' => $part->printing_colour,
                    'job_bundle_qty' => $part->bundle_qty,
                    'job_part_category' => $part->part_category,
                    'job_part_description' => fake()->sentence(),
                    'job_part_price' => $part->part_price,
                    'job_part_quantity' => fake()->numberBetween(50, 500),
                    'job_bst' => $part->bst,
                    'job_lain' => $part->plain,
                    'job_flat' => $part->flat,
                    'job_gazzate' => $part->gazzate,
                    'job_bio' => $part->bio,
                    'job_normal' => $part->normal,
                    'job_milky' => $part->milky,
                    'job_roto_printing' => $part->roto_printing,
                    'job_flexo_printing' => $part->flexo_printing,
                    'job_sideseal' => $part->sideseal
                ]);
            }
        }
    }
}