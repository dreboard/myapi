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
require_once '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Controllers;

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/../src/dependencies.php';// Set up dependencies

require __DIR__ . '/../src/middleware.php';// Register middleware

require __DIR__ . '/../src/routes.php';// Register routes

$app->get('/find_user2/{id:[0-9]+}', '\App\Controllers\UserController:find_user');

$app->get('/find/{id}', function (Request $request, Response $response, $args) {
	$sth = $this->db->prepare("SELECT * FROM users WHERE id=:id");
	$sth->bindParam("id", $args['id']);
	$sth->execute();
	$user = $sth->fetchObject();
	return $this->response->withJson($user);
});

$app->get('/user/{name}/{age}', function (Request $request, Response $response) {
	$name = $request->getAttribute('name');
	$age = $request->getAttribute('age');
	echo $name, ' ', $age;
});


$app->run();