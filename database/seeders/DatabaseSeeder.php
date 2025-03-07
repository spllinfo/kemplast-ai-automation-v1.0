<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Department;
use App\Models\ProductionPlan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Settings
        $this->call(SettingSeeder::class);

        // 2. Create Branches
        $this->call(BranchSeeder::class);
        $branches = Branch::all();

        // 3. Create Departments
        $this->call(DepartmentSeeder::class);

        // 4. Create Users with different roles
        $this->call(UserSeeder::class);

        // 5. Create Staff Members
        $this->call(StaffSeeder::class);

        // 6. Create Customers
        $this->call(CustomerSeeder::class);

        // 7. Create Suppliers
        $this->call(SupplierSeeder::class);

        // 8. Create Machines
        $this->call(MachineSeeder::class);

        // 9. Create Materials and Material Stocks
        $this->call([
            MaterialSeeder::class,
            MaterialStockSeeder::class,
        ]);

        // 10. Create Parts
        $this->call(PartSeeder::class);

        // 11. Create Production Plans
        $this->call(ProductionPlanSeeder::class);

        // 12. Create Production Stages
        $this->call(ProductionStageSeeder::class);

        // 13. Create Material Assignments
        $this->call(MaterialAssignmentSeeder::class);

        // 14. Create Production Processes
        $this->call([
            ExtrusionProcessSeeder::class,
            PrintingProcessSeeder::class,
            LaminationProcessSeeder::class,
            SlittingProcessSeeder::class,
        ]);

        // 15. Create Quality Checks
        $this->call([
            QualityCheckSeeder::class,
            MaterialQualityCheckSeeder::class,
        ]);

        // 16. Create Material Mixing Batches
        $this->call(MaterialMixingBatchSeeder::class);

        // 17. Create Dispatch Processes and Documents
        $this->call([
            DispatchProcessSeeder::class,
            DispatchDocumentSeeder::class,
        ]);

        // Log completion
        info('Database seeding completed successfully');
    }
}
