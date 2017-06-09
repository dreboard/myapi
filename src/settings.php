<?php
return [
	'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'outputBuffering' => false,
        'displayErrorDetails' => true,

		// Renderer settings

		// Monolog settings

		// Database connection settings
		"db" => [
			"host"   => "localhost",
			"dbname" => "api",
			"user"   => "root",
			"pass"   => ""
		],
        'illuminate' => [
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
];