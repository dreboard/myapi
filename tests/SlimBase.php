<?php
namespace APITesting;

require_once "../vendor/autoload.php";
/**
 * Base class for slim/phpunit integration
 */

use PHPUnit\Framework\{
	TestCase
};

class SlimBase extends TestCase {

	protected $container;

	public function setUp(  ) {
		$settings = require __DIR__ . '/../src/settings.php';

		$app = new \Slim\App($settings);

		require __DIR__ . '/../src/dependencies.php';// Set up dependencies

		require __DIR__ . '/../src/middleware.php';// Register middleware

		require __DIR__ . '/../src/routes.php';// Register routes

		$this->container = $app->getContainer()->get("db");
		$app->run();
	}
}