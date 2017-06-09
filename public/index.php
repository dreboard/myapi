<?php
/**
 * Entry point for MyAPI.
 *
 * @package    myapi
 * @subpackage main
 * @author     Andre Board
 * @version    v0.1.0
 * @since 0.1.0
 *
 */
require_once __DIR__ .'/../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Controllers;

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';

//$app = (new System\App())->get();
$app = new \Slim\App($settings);

require __DIR__ . '/../src/dependencies.php';// Set up dependencies

require __DIR__ . '/../src/middleware.php';// Register middleware

require __DIR__ . '/../src/routes.php';// Register routes

$app->getContainer()->get("db");
$app->run();