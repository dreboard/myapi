<?php
namespace System;

use \Interop\Container\ContainerInterface as ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use App\Helpers\RouteHelper;
/**
 * Class BaseController
 * @package System
 */
class BaseController {

	/**
	 * @var $container
	 */
	protected $container;

	/**
	 * @var array
	 */
	protected $lang;

	/**
	 * @var Logger
	 */
	protected $logger;

	/**
	 * BaseController constructor.
	 *
	 * @param $c
	 */
	public function __construct($c)
	{
		$this->logger = new Logger('api_logger');
		$this->logger->pushHandler(new StreamHandler(
		    __DIR__.'/../logs/app.log', Logger::DEBUG));
		$this->logger->pushHandler(new FirePHPHandler());
		$this->container = $c;
		$this->lang = require __DIR__ . '/../config/lang.php';
	}

	/**
	 * @param $property
	 *
	 * @return mixed
	 */
	public function __get($property) {
		if($this->container->has($property)) {
			return $this->container->get($property);
		}

		return $this->{$property};
	}
}