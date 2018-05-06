<?php

// DIC configuration
$container = $app->getContainer();

$container['auth-action-up'] = function($c){
    return new \Bitsbybit\Math\Auth\Action\UpAction($c);
};

$container['auth-action-health'] = function($c){
    return new \Bitsbybit\Math\Auth\Action\HealthAction($c);
};

$container['auth-action-login'] = function($c){
    $settings = $c->get('settings');
    return new \Bitsbybit\Math\Auth\Action\Login(
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