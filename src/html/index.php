<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../Bitsbybit/settings.php';

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../Bitsbybit/dependencies.php';

// Register middleware
require __DIR__ . '/../Bitsbybit/middleware.php';

// Register routes
require __DIR__ . '/../Bitsbybit/routes.php';

// Run app
$app->run();