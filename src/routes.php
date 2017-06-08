<?php
/**
 * Master routes file
 */

try{
	$app->get('/find_user/{id:[0-9]+}', '\App\Controllers\UserController:find_user');

	$app->group('/users', function () {
		$this->get('/by/{id:[0-9]+}', '\App\Controllers\UserController:find_user');
		$this->map(['PUT', 'POST'], '/add_user', '\App\Controllers\UserController:add_user');
		$this->map(['GET', 'POST'], '/all', '\App\Controllers\UserController:get_all_users');
	});

	$app->group('/events', function () {
		$this->get('/by/{id:[0-9]+}', 'App\Controllers\EventController:getEvents');
		$this->post('/new', 'App\Controllers\EventController:createEvent');
		$this->delete('/by/{id:[0-9]+}', 'App\Controllers\EventController:deleteEvent');
	});

} catch (Throwable $e){
	echo json_encode($e->getMessage());
}