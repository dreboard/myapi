<?php
namespace System;

use PDO;

/**
 * Class BaseModel
 * @package System
 * @subpackage  Models
 * @author      Andre Board
 * @since       v0.1.0
 */
class BaseModel {
	/**
	 * @var PDO
	 */
	protected $dsn;
	/**
	 * @var mixed
	 */
	protected $lang;
	/**
	 * @var
	 */
	protected $config;

	/**
	 * BaseModel constructor.
	 *
	 * @param $dsn
	 */
	public function __construct() {
		$this->lang = require __DIR__ . '/../config/lang.php';
		$this->config = require __DIR__.'/../src/settings.php';
        try{
            $this->dsn = new \PDO(
                "mysql:host={$this->config['settings']['db']['host']};dbname={$this->config['settings']['db']['database']}",
                $this->config['settings']['db']['username'],
                $this->config['settings']['db']['password']);
            $this->dsn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->dsn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
        } catch (\PDOException $e){
            echo $e->getMessage();
        }
	}
}
