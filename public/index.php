<?php
/**
 * Entry point for API.
 *
 * @package    myapi
 * @version    v0.1.0
 *
 */

$settings = require __DIR__ . '/../src/composer.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Controllers;
use \Illuminate\Database\Capsule\Manager as Capsule;

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$lang  = require __DIR__ . '/../config/lang.php';
$app = new \Slim\App($settings);

require __DIR__ . '/../src/dependencies.php';// Set up dependencies

require __DIR__ . '/../src/middleware.php';// Register middleware

require __DIR__ . '/../src/routes.php';// Register routes

$app->getContainer()->get("db");
$app->run();