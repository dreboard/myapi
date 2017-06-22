<?php

namespace APITesting;
require_once "../vendor/autoload.php";

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 6/14/2017
 * Time: 10:22 PM
 */

use App\Controllers\{
    HomeController, UserController
};
use PHPUnit\Framework\{
    TestCase
};
use Slim\Http\Environment;

class HomeControllerTest extends SlimBase
{

    private $home;
    private $user;

    public function setUp()
    {

        parent::setUp();

        $this->home = new HomeController();
        $this->user = new UserController($this->container);
    }

    /**
     * @covers HomeController::get_version
     */
    public function testGetRequestReturnsString()
    {
        // We need a request and response object to invoke the action
        $environment = Environment::mock([
                'REQUEST_METHOD' => 'GET',
                'REQUEST_URI' => '/get_version',
                'QUERY_STRING' => 'foo=bar']
        );
        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $response = new \Slim\Http\Response();

        // run the controller action and test it
        $response = $this->home->get_version($request, $response);
        $this->assertSame((string)$response->getBody(), '{"version":"v1.0"}');
    }

    /**
     * @covers HomeController::get_version
     */
    public function testInsertUser()
    {
        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/v1/users/add_user',
            'QUERY_STRING' => 'first=Alex&last=Board&email=alex.board@gmail.com',
            'CONTENT_TYPE' => 'application/x-www-form-urlencoded;charset=utf8',
        ]);

        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $response = new \Slim\Http\Response();

        // run the controller action and test it
        $response = $this->user->add_user($request, $response);
        $this->assertSame((string)$response->getBody(), '{"status":"success","errors":"none"}');
    }

}
