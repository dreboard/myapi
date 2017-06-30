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
 * Per the user guide The Content-Type of the Response is automatically set to
 * application/json;charset=utf-8, so (withStatus(200)) is not necessary
 * return $response->withJson($data, 201) can be used to change
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \System\BaseController;
use \PDO;
use \PDOException;
use \PDOStatement;

class RouteController extends BaseController
{


}