<?php

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

// DIC configuration
$container = $app->getContainer();

$container['errorHandler'] = function ($c) {
    return new \Bitsbybit\Math\Action\ErrorHandler();
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['action-up'] = function($c){
    return new \Bitsbybit\Math\Action\UpAction($c);
};

$container['action-health'] = function($c){
    return new \Bitsbybit\Math\Action\HealthAction($c);
};

$container['action-login'] = function($c){
    $settings = $c->get('settings');
    return new \Bitsbybit\MathAuth\Action\Login(
        $c,
        $c->get('aws-cognito-client'),
        $settings['cognitoPoolId']
    );
};

$container['aws-cognito-client'] = function($c){
    $settings = $c->get('settings');
    return new \Aws\CognitoIdentityProvider\CognitoIdentityProviderClient([
        'key' => $settings['awsKey'],
        'secret' => $settings['awsSecret'],
        'region'  => $settings['awsRegion']
    ]);
};

return $container;