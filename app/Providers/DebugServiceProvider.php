<?php

namespace App\Providers;

use App\Http\Middleware\RequestResponseLogger;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DebugServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (App::environment(['local', 'development', 'staging'])) {
            // Register the middleware
            $this->app['router']->aliasMiddleware('request-logger', RequestResponseLogger::class);
            $this->app['router']->pushMiddlewareToGroup('web', RequestResponseLogger::class);

            // Enable SQL query logging
            DB::listen(function($query) {
                Log::channel('request-monitor')->debug(
                    'SQL Query',
                    [
                        'sql' => $query->sql,
                        'bindings' => $query->bindings,
                        'time' => $query->time . 'ms'
                    ]
                );
            });

            // Log all exceptions
            $this->app->singleton(
                \Illuminate\Contracts\Debug\ExceptionHandler::class,
                function ($app) {
                    return new class($app) extends \App\Exceptions\Handler {
                        public function report(\Throwable $e)
                        {
                            Log::channel('request-monitor')->error(
                                'Exception',
                                [
                                    'message' => $e->getMessage(),
                                    'file' => $e->getFile(),
                                    'line' => $e->getLine(),
                                    'trace' => $e->getTraceAsString()
                                ]
                            );
                            parent::report($e);
                        }
                    };
                }
            );
        }
    }

    public function boot()
    {
        //
    }
}