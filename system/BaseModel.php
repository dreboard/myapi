<?php
namespace System;
/**
 * BaseModel
 */

class BaseModel {
	protected $dsn;

	public function __construct(\PDO $dsn)
	{
		$this->dsn = $dsn;
	}
}