<?php
namespace System;
/**
 * BaseModel
 */
use PDO;

class BaseModel {
	protected $dsn;

	public function __construct() {
		$this->dsn = new PDO( 'mysql:host=localhost;dbname=api', 'root', '' );
		$this->dsn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$this->dsn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
	}
}