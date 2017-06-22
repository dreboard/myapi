<?php
namespace System;

/**
 * BaseModel and initial PDO DSN
 *
 * @package     MyAPI\System
 * @subpackage  Models
 * @author      Andre Board
 * @since       v0.1.0
 *
 */
use PDO;

class BaseModel {
	protected $dsn;

	public function __construct() {
	    try{
            $this->dsn = new \PDO( 'mysql:host=localhost;dbname=api', 'root', '' );
            $this->dsn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->dsn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
        } catch (\PDOException $e){
            echo $e->getMessage();
        }
	}
}
