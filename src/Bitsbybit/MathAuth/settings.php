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
        'baseUrl' => '/api/users',
        'awsRegion' => getenv('aws_region'),
        'awsKey' => getenv('aws_access_key_id'),
        'awsSecret' => getenv('aws_secret_access_key'),
        'dynamoTable' => getenv('dynamo_table_name'),
        'cognitoPoolId' => getenv('cognito_app_client_id')
    ]
];

return $settings;
