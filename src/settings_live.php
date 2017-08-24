<?php
return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'outputBuffering' => false,
        'displayErrorDetails' => true,

        // Renderer settings

        // Monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        // Database connection settings
        'db' => [
	        'driver' => 'mysql',
	        'host' => '108.167.189.13',
	        'database' => 'dreboard_api',
	        'username' => 'dreboard',
	        'password' => '8rtZin)hTc0h',
	        'charset'   => 'utf8',
	        'collation' => 'utf8_unicode_ci',
	        'prefix'    => '',
        ],
    ],
];