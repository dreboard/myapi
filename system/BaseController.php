<?php
namespace System;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class BaseController {
	protected $container;

	public function __construct($c)
	{
		$this->container = $c;
	}

	public function __get($property) {
		if($this->container->has($property)) {
			return $this->container->get($property);
		}

		return $this->{$property};
	}
}