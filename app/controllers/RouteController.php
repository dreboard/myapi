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
use App\Components\GoogleAnalytics;
use \PDO;
use \PDOException;
use \PDOStatement;

class RouteController extends BaseController
{
    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;

    public static function get()
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf(
            'v%s.%s.%s-dev.%s (%s)',
            self::MAJOR,
            self::MINOR,
            self::PATCH,
            $commitHash,
            $commitDate->format('Y-m-d H:m:s')
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function routeDetails(Request $request, Response $response, $args)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        $user_agent = $request->getHeaderLine('User-Agent');
        $ip = 23435252;
        $user_array = ["{$path}", "{$user_agent}", "{$ip}", ""];

        GoogleAnalytics::gaSendData($path, $user_agent);
        return $response->withStatus(200)->withJson($user_array);
    }

}