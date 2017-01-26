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

require_once 'vendor/autoload.php';

$c = new \Slim\Container(); //Create Your container

//Override the default Not Found Handler
$c['notFoundHandler'] = function ($c) {
	return function ($request, $response) use ($c) {
		return $c['response']
			->withStatus(404)
			->withHeader('Content-Type', 'text/html')
			->write('Page not found');
	};
};

$app = new \Slim\App($c);

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

/**
 * @todo Add versioning
 */
$app->group('/v1', function(){

});
$app->get('/allusers', function(Request $request, Response $response, $args){
	$users = User::getUsers();
	if($users){
		$user_array = [];
		foreach ($users as $user){
			$user_array[$user->id] = [
				'name' => $user->name,
				'email' => $user->email,
				'age' => $user->age
			];
		}
		return $response->withStatus(200)->withJson($user_array);
	} else {
		return $response->withStatus(400);
	}

});

$app->get('/getip', function(Request $request, Response $response, $args){
	echo $_SERVER['REMOTE_HOST'];
});

$app->run();