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
            'driver' => 'mysqli',
            'host' => '52.168.135.130',
            'database' => 'incentis_members_test',
            'username' => 'incentis_app',
            'password' => 'DQJG!KaW+qrsHh7=',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
	],
];

/*return [
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
            'host' => 'localhost',
            'database' => 'api',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ],
];*/