<?php
require_once 'vendor/autoload.php';

$config['displayErrorDetails'] = true;
$app = new \Slim\App(['settings' => $config]);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \MyAPI\Application\User;


//$app->contentType('application/json');
/*$app->get('/users', 'User::getUsers');
$app->get('/user/:id', 'User::getUser');
$app->post('/user', 'User::addUser');
$app->put('/user/:id', 'User::updateUser');
$app->delete('/user/:id', 'User::deleteUser');


$app->get('/allusers', function(Request $request, Response $response, $args){
	$user = User::getUsers();
	return $response->write($user);
});
*/
$app->get('/allusers', function(Request $request, Response $response, $args){
	$users = User::getUsers();
	$user_array = [];
	foreach ($users as $user){
		$user_array[$user->id] = [
			'name' => $user->name,
			'email' => $user->email,
			'age' => $user->age
		];
	}
	return $response->withStatus(201)->withJson($user_array);
});



$app->run();