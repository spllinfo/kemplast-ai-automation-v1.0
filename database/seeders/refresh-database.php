<?php

// This file is a helper script to completely refresh the database
// It's not a standard Laravel file, but a custom script to help with database refreshing

echo "
==================================================
      KEMPLAST DATABASE REFRESH HELPER
==================================================

This script helps you refresh your database with properly
populated test data including users and staff with emergency contacts.

To run this script, execute:
php database/seeders/refresh-database.php

To manually refresh the database, run these commands:
1. php artisan migrate:fresh --seed
";

// Get the application path
$basePath = dirname(dirname(__DIR__));

// Change to the base directory
chdir($basePath);

echo "\nChanging to directory: " . $basePath . "\n";
echo "Current working directory: " . getcwd() . "\n\n";

echo "Starting database refresh...\n";
echo "==================================================\n";

// Execute the migration:fresh command to drop all tables and recreate them
echo "Dropping all tables and recreating from migrations...\n";
system('php artisan migrate:fresh');

// Run migrations
echo "\nApplying migrations...\n";
system('php artisan migrate');

// Clear cache
echo "\nClearing cache...\n";
system('php artisan cache:clear');

// Clear config cache
echo "\nClearing config cache...\n";
system('php artisan config:clear');

// Run database seeders
echo "\nSeeding database with test data...\n";
system('php artisan db:seed');

echo "\n==================================================\n";
echo "Database refresh completed successfully!\n";
echo "Your database now has:\n";
echo "- Users with proper data in all fields\n";
echo "- Staff records linked to users with proper relationships\n";
echo "- Emergency contact information for all staff\n";
echo "==================================================\n";

echo "\nLogin with:\n";
echo "Email: admin@kemplast.net\n";
echo "Password: password\n\n";