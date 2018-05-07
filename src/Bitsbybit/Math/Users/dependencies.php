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

$container['users-repository-user'] = function($c){
    return new \Bitsbybit\Math\Users\Repository\User();
};

$container['users-service-user'] = function($c){
    return new \Bitsbybit\Math\Users\Service\User($c->get('users-repository-user'));
};

$container['users-action-user'] = function($c){
    return new \Bitsbybit\Math\Users\Action\UserAction($c, $c->get('users-service-user'));
};

return $container;