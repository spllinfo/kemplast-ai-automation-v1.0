<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RequestResponseLogger
{
    public function handle(Request $request, Closure $next)
    {
        // Start timing
        $startTime = microtime(true);

        // Log the request
        Log::channel('request-monitor')->info('Incoming Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
        ]);

        // Enable query logging
        DB::enableQueryLog();

        $response = $next($request);

        // Calculate execution time
        $executionTime = microtime(true) - $startTime;

        // Get database queries
        $queries = DB::getQueryLog();

        // Log the response
        Log::channel('request-monitor')->info('Outgoing Response', [
            'status_code' => $response->getStatusCode(),
            'execution_time' => round($executionTime * 1000, 2) . 'ms',
            'memory_usage' => round(memory_get_peak_usage(true) / 1024 / 1024, 2) . 'MB',
            'queries' => array_map(function ($query) {
                return [
                    'sql' => $query['query'],
                    'bindings' => $query['bindings'],
                    'time' => $query['time'] . 'ms'
                ];
            }, $queries)
        ]);

        // Disable query logging
        DB::disableQueryLog();

        return $response;
    }
}