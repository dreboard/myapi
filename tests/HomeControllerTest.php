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
	HomeController
};
use PHPUnit\Framework\{
	TestCase
};
use Slim\Http\Environment;

class HomeControllerTest extends TestCase {

	private $home;

	protected function setUp(){
		$this->home = new HomeController();
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
				'QUERY_STRING'=>'foo=bar']
		);
		$request = \Slim\Http\Request::createFromEnvironment($environment);
		$response = new \Slim\Http\Response();

		// run the controller action and test it
		$response = $this->home->get_version($request, $response);
		$this->assertSame((string)$response->getBody(), '{"version":"v1.0"}');
	}
}
