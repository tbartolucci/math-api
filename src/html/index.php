<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../Bitsbybit/MathAuth/settings.php';

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../Bitsbybit/MathAuth/dependencies.php';

// Register middleware
require __DIR__ . '/../Bitsbybit/MathAuth/middleware.php';

// Register routes
$baseRoute = $settings['settings']['baseUrl'];
require __DIR__ . '/../Bitsbybit/MathAuth/routes.php';
require __DIR__ . '/../Bitsbybit/MathAuth/v1-routes.php';

// Run app
$app->run();