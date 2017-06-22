<?php
/**
 * Master routes file
 */

/**
 * Version 1.0 routes file
 */
$app->get( '/get_version', '\App\Controllers\HomeController:get_version' );

$app->group( '/v1', function () use ( $app ) {

	$this->get( "/", function ( $request, $response, $args ) {
		return $response->withStatus( 201 )
		                ->withHeader( 'Content-Type', 'application/json' )
		                ->write( json_encode( [ 'version' => 'v1.0' ] ) );
	} );

	$app->group( '/users', function () {
		$this->get( '/by/{id:[0-9]+}', '\App\Controllers\UserController:findUser' );
		$this->post('/add_user', '\App\Controllers\UserController:addUser' );
		$this->map( [ 'GET', 'POST' ], '/all', '\App\Controllers\UserController:getAllUsers' );
	} );
});

