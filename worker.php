<?php

use Laravel\Octane\RequestContext;
use Laravel\Octane\Stream;
use Laravel\Octane\Worker;

require __DIR__.'/vendor/autoload.php';

$app = require __DIR__.'/bootstrap/app.php';

$worker = new Worker(
    new RequestContext,
    $app,
    new Stream(fopen('php://stdout', 'w'), fopen('php://stderr', 'w'))
);

$worker->start();