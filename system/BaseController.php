<?php
namespace System;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class BaseController {

	protected $container;

    protected $lang;

	public function __construct($c)
	{
		$this->container = $c;
		$this->lang = require __DIR__ . '/../config/lang.php';
	}

	public function __get($property) {
		if($this->container->has($property)) {
			return $this->container->get($property);
		}

		return $this->{$property};
	}
}