<?php

/**
 * Version 2.x Routing
 * Send uri and responses to google analytics
 *
 * @package     App\Routes
 * @subpackage  Includes
 * @since       v0.1.0
 *
 */
$app->group( '/v2', function () use ( $app ) {

	$this->get( "/", function ( $request, $response, $args ) {
		return $response->withStatus( 201 )
		                ->withHeader( 'Content-Type', 'application/json' )
		                ->write( json_encode( [ 'version' => 'v2.0' ] ) );
	} );

	$app->group( '/users', function () {
		$this->get( '/by/{id:[0-9]+}', '\App\Controllers\UserController:findUserRequest' );
		$this->delete( '/by/{id:[0-9]+}', '\App\Controllers\UserController:deleteUserRequest' );
		$this->post('/add_user', '\App\Controllers\UserController:addUserRequest' );
		$this->map( [ 'GET', 'POST' ], '/all', '\App\Controllers\UserController:getAllUsers' );
	} );
});