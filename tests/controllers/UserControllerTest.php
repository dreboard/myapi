<?php
namespace APITesting;
require_once "../../vendor/autoload.php";

use PHPUnit\Framework\{
	TestCase
};
use Slim\Http\Environment;
use Slim\Http\Request;

/**
 * Class UserControllerTest
 * @package APITesting
 *
 * This class will cover all methods of the UserController
 *
 * @internal these methods can be tested in the terminal (see below)
 * @example curl http://localhost/api/myapi/public/v1/users/by/1 -v
 * @example or by using the -d flag for posts
 */
class UserControllerTest extends TestBase{

	protected $app;

	public function setUp()
	{
		$this->app = new \Slim\App();
	}

	public function testGetHomepageWithoutName()
	{
		try {
			$response = $this->runApp('GET', '/v1/');
			$this->assertEquals(201, $response->getStatusCode());
			$this->assertContains('{"version":"v1.0"}', (string)$response->getBody());
			$this->assertNotContains('Hello', (string)$response->getBody());
		}
		catch(\Exception $e) {
			$this->fail();
		}
	}

	/**
	 * Create new user test
	 * for tesing POST requests
	 * @covers UserController::addUserRequest
	 */
	public function testUserInsert()
	{
		try {
			$data = '{"first":"Andre", "last":"Jackson", "email":"dre.board@gmail.com"}';
			$input = json_decode($data, true);

			$response = $this->runApp('POST', '/v1/users/add_user', $input);
			$this->assertEquals(201, $response->getStatusCode());
			$this->assertContains('{"status":"success","errors":"none"}', (string)$response->getBody());

		}
		catch(\Exception $e) {
			$this->fail();
		}
	}
	/**
	 * Create new user test
	 * for tesing POST requests
	 * @covers UserController::findUserRequest
	 */
	public function testGetUser()
	{
		try {
			$response = $this->runApp('GET', '/v1/users/by/1');
			$this->assertEquals(200, $response->getStatusCode());
		}
		catch(\Exception $e) {
			$this->fail();
		}
	}

	/**
	 * Ensure that a get controller method
	 * returns a 405 error when using POST
	 * for a method expecting a GET request
	 *
	 * @covers UserController::findUserRequest
	 */
	public function testGetUserFailWrongMethod()
	{
		try {
			$response = $this->runApp('POST', '/v1/users/by/1');
			$this->assertEquals(405, $response->getStatusCode());
			$data = json_decode($response->getBody(true), true);
			$this->assertArrayHasKey('method_error', $data);
		}
		catch(\Exception $e) {
			$this->fail();
		}
	}
}