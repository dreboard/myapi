<?php
$app->group('/v1', function () use ($app) {

    $this->get("/", function ($request, $response, $args) {
        return $response->withJson(['version' => 'v0']);
    });

    $app->group('/users', function () {
        $this->get('/get_users', '\App\Controllers\UserController:get_users');
        $this->get('/by/{id:[0-9]+}', '\App\Controllers\UserController:findUserRequest');
        $this->delete('/by/{id:[0-9]+}', '\App\Controllers\UserController:deleteUserRequest');
        $this->post('/add_user', '\App\Controllers\UserController:addUserRequest');
        $this->map(['GET', 'POST'], '/all', '\App\Controllers\UserController:getAllUsers');
    });
});
