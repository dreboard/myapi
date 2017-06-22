<?php
namespace APITesting;
require_once "../vendor/autoload.php";

use PHPUnit\Framework\{
	TestCase
};
use Slim\Http\Environment;
use Slim\Http\Request;

class BasicTest extends SlimBase{

	protected $app;

	public function setUp()
	{
		$this->app = new \Slim\App();
	}

	public function testGetHomepageWithoutName()
	{
		$response = $this->runApp('GET', '/v1/');
		$this->assertEquals(201, $response->getStatusCode());
		$this->assertContains('{"version":"v1.0"}', (string)$response->getBody());
		$this->assertNotContains('Hello', (string)$response->getBody());
	}

	public function testUserInsert()
	{
		$data = '{"first":"Andre", "last":"Jackson", "email":"dre.board@gmail.com"}';
		$input = json_decode($data, true);

		$response = $this->runApp('POST', '/v1/users/add_user', $input);
		$this->assertContains('{"status":"success","errors":"none"}', (string)$response->getBody());
		//$this->assertEquals(201, $response->getStatusCode());
	}

}