<?php
$settings = [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Monolog settings
        'logger' => [
            'name' => 'bitsbybit-math-auth',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'awsRegion' => getenv('aws_region'),
        'awsKey' => getenv('aws_access_key_id'),
        'awsSecret' => getenv('aws_secret_access_key'),
    ]
];

$settings['settings']['auth'] = require __DIR__ . '/Math/Auth/settings.php';
$settings['settings']['users'] = require __DIR__ . '/Math/Users/settings.php';

return $settings;
