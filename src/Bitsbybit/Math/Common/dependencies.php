<?php

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Bitsbybit\Math\Common\Action\ErrorHandler;

// DIC configuration
$container = $app->getContainer();

$container['errorHandler'] = function ($c) {
    return new ErrorHandler();
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};