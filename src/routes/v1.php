<?php
$app->group('/v1', function () use ($app) {

    $this->get("/", function ($request, $response, $args) {
        return $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Vary', 'Accept-Encoding')
            ->withHeader('Link', '<http://www.site.ch/TheBook/chapter2>; rel="Previous"')
            ->write(json_encode(['version' => 'v1.0']));
    });

    $app->group('/users', function () {
        $this->get('/get_users', '\App\Controllers\UserController:get_users');
        $this->get('/by/{id:[0-9]+}', '\App\Controllers\UserController:findUserRequest');
        $this->delete('/by/{id:[0-9]+}', '\App\Controllers\UserController:deleteUserRequest');
        $this->post('/add_user', '\App\Controllers\UserController:addUserRequest');
        $this->map(['GET', 'POST'], '/all', '\App\Controllers\UserController:getAllUsers');
    });
});
