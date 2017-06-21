<?php
namespace App\Models;

use System\BaseModel;
/**
 * class UserDAO
 * User Data Access Object
 * @package     MyAPI\Application
 * @subpackage  Models
 * @author      Andre Board
 * @version     v0.1.0
 * @since       0.1.0
 *
 */
class UserDAO extends BaseModel{

	protected $sql = [
		"insert_user" => "INSERT INTO users (first, last, email) VALUES (:first, :last, :email)"
	];

	public function __construct(  ) {
		parent::__construct();

	}

	/**
	 * @param array $data
	 *
	 * @return bool|string
	 */
	public function insertUser( array $input ) {
		try {
			$stmt = $this->dsn->prepare( $this->sql['insert_user'] );
			$stmt->bindParam( ":first", $input['first'], PDO::PARAM_STR );
			$stmt->bindParam( ":last", $input['last'], PDO::PARAM_STR );
			$stmt->bindParam( ":email", $input['email'], PDO::PARAM_STR );
			$stmt->execute();
			return true;
		} catch ( \PDOException $e ) {
			return $e->getMessage();
		}
	}

}