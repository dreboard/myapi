<?php
namespace APITesting;

require_once "../vendor/autoload.php";
/**
 * Base class for slim/phpunit integration
 */

use PHPUnit\Framework\{
	TestCase
};
use Slim\App;

class SlimBase extends TestCase {

	protected $container;
	protected $app;

    /**
     * Test base class setup
     */
    public function setUp()
    {
		$settings = require __DIR__ . '/../src/settings.php';
		$this->app = new App($settings);
		require __DIR__ . '/../src/dependencies.php';// Set up dependencies
		require __DIR__ . '/../src/middleware.php';// Register middleware
		require __DIR__ . '/../src/routes.php';// Register routes

		$this->container = $this->app->getContainer()->get("db");
        $this->app->run();
	}
}