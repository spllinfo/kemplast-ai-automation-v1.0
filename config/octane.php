<?php

return [
    'server' => 'roadrunner',
    'workers' => env('OCTANE_WORKERS', 4),  // Increased for better concurrency
    'tasks' => env('OCTANE_TASKS', 3),      // Increased for background jobs
    'max_execution_time' => 60,             // Increased for complex operations
    'host' => '127.0.0.1',
    'port' => 8000,

    'listeners' => [
        'task' => [
            'reset' => [
                \Illuminate\Database\QueryException::class,
                \Illuminate\Session\TokenMismatchException::class,
            ],
        ],
    ],

    'warm' => [
        \App\Models\User::class,            // Frequently accessed models
        \App\Models\ProductionPlan::class,
    ],

    'max_execution_time' => 30,

    'host' => '127.0.0.1',
    'port' => 8000,

    'workers' => env('OCTANE_WORKERS', 2),
    'tasks' => env('OCTANE_TASKS', 2),
];
