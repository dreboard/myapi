<?php
namespace APITesting;

use Slim\{App, Http\Environment, Http\Request, Http\Response};
use PHPUnit\Framework\{
	TestCase
};

/**
 * Class TestBase
 * @package APITesting
 *
 * Base class for slim/phpunit integration
 * set up a method that runs the application.
 */
class TestBase extends TestCase
{
	/**
	 * Use middleware when running application?
	 *
	 * @var bool
	 */
	protected $withMiddleware = true;

	/**
	 * Process the application given a request method and URI
	 * Create a mock environment for testing with
	 *
	 * @param string $requestMethod the request method (e.g. GET, POST, etc.)
	 * @param string $requestUri the request URI
	 * @param array|object|null $requestData the request data
	 * @return \Slim\Http\Response
	 */
	public function runApp($requestMethod, $requestUri, $requestData = null)
	{
		$environment = Environment::mock(
			[
				'REQUEST_METHOD' => $requestMethod,
				'REQUEST_URI' => $requestUri
			]
		);
		$request = Request::createFromEnvironment($environment);
		if (isset($requestData)) {
			$request = $request->withParsedBody($requestData);
		}
		$response = new Response();
		$settings = require __DIR__ . '/../src/settings.php';
		$app = new App($settings);

		require __DIR__ . '/../src/dependencies.php';

		if ($this->withMiddleware) {
			require __DIR__ . '/../src/middleware.php';
		}

		require __DIR__ . '/../src/routes.php';
		$response = $app->process($request, $response);
		return $response;
	}
}