<?php
/**
 * Version 1.x Routing
 * Send uri and responses to google analytics
 *
 * @package     App\Routes
 * @subpackage  Includes
 * @since       v0.1.0
 *
 */
$app->group('/v1', function () use ($app) {

	$this->get("/1", function ($request, $response, $args) {
		return $response->withJson(['version' => 'v0']);
	});
    $this->get("/", function ($request, $response, $args) {
        return $response->withJson(['version' => 'v0', 'get_var' => $_ENV['APPLICATION_ENV']]);
    });
	$this->post("/", function ($request, $response, $args) {
		try{
			if($request->getHeaderLine('API_Auth') == 123){
				return $response->withJson(['version' => 'v0', 'post_var' => $_POST['input']]);
			} else{
				return $response->withJson(['message' => 'Unauthorized User']);
			}
		}catch(Throwable $e) {

		}

	});

    $app->group('/route', function () {
        $this->get('/', '\App\Controllers\RouteController:routeDetails');
    });
    $app->group('/users', function () {
        $this->get('/get_users', '\App\Controllers\UserController:get_users');
        $this->get('/by/{id:[0-9]+}', '\App\Controllers\UserController:findUserRequest');
        $this->delete('/by/{id:[0-9]+}', '\App\Controllers\UserController:deleteUserRequest');
        $this->post('/add_user', '\App\Controllers\UserController:addUserRequest');
        $this->map(['GET', 'POST'], '/all', '\App\Controllers\UserController:getAllUsers');
    });
})->add( new App\Middleware\ExampleMiddleware());
