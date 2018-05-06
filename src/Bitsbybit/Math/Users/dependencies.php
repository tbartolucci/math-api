<?php

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

// DIC configuration
$container = $app->getContainer();

$container['users-action-up'] = function($c){
    return new \Bitsbybit\Math\Users\Action\UpAction($c);
};

$container['users-action-health'] = function($c){
    return new \Bitsbybit\Math\Users\Action\HealthAction($c);
};

return $container;