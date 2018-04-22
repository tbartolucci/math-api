<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
// Get OpenBalance API ex: http://10.4.32.163:8000/getOpenBalance/899/9159660999
$app->get($baseRoute . '/health', function (Request $request, Response $response, $args) {
    $action = $this->get('action-health');
    return $action->go($request, $response, $args);
});

$app->get($baseRoute . '/up', function (Request $request, Response $response, $args) {
    $action = $this->get('action-health');
    return $action->go($request, $response, $args);
});