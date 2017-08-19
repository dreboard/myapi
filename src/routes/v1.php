<?php
$app->group('/v1', function () use ($app) {

	$checkProxyHeaders = true; // Note: Never trust the IP address for security processes!
	$trustedProxies = ['10.0.0.1', '10.0.0.2']; // Note: Never trust the IP address for security processes!
	$app->add(new RKA\Middleware\IpAddress());

    $this->get("/", function ($request, $response, $args) {
        return $response->withJson(['version' => 'v0', 'environment' => $_SERVER['APPLICATION_ENV']]);
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
