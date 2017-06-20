<?php
namespace App\Controllers;
/**
 * MyAPI user class.
 *
 * @package     MyAPI\Application
 * @subpackage  Controllers
 * @author      Andre Board
 * @version     v0.1.0
 * @since       0.1.0
 *
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \PDO;
use \PDOException;
use \App\Models\User;

class HomeController extends \System\BaseController{

    public function __construct(){}

    /**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @internal param int $id
	 */
	public function get_version(Request $request, Response $response) {
		return $response->withStatus( 201 )
		                ->withHeader( 'Content-Type', 'application/json' )
		                ->write( json_encode( [ 'version' => 'v1.0' ] ) );
	}

}