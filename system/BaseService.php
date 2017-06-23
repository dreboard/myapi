<?php
namespace System;

/**
 * Class BaseService
 * @package System
 */
class BaseService {

	/**
	 * @var array
	 */
	protected $lang;

	/**
	 * BaseService constructor.
	 *
	 */
	public function __construct()
	{
		$this->lang = require __DIR__ . '/../config/lang.php';
	}


}