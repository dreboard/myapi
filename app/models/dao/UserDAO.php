<?php
namespace App\Models;

use System\BaseModel;
use PDO, PDOException, PDOStatement;

/**
 * Class UserDAO
 * User Data Access Object
 *
 * @package     App\Models
 * @subpackage  Controllers
 * @author      Andre Board
 * @since       v0.1.0
 *
 */

class UserDAO extends BaseModel{

    protected $sql = [
        "insert" =>
            [
                "new_user" => "INSERT INTO users (first, last, email) VALUES (:first, :last, :email)",
            ],
        "select" =>
            [
                "all" => "SELECT * FROM users",
                "by_id" => "SELECT * FROM users WHERE id=:id"
            ],
        "delete" =>
            [
                "by_id" => "DELETE FROM users WHERE id=:id"
            ],
    ];

    /**
     * UserDAO constructor.
     */
    public function __construct(  )
    {
		parent::__construct();
	}

    /**
     * Find all users
     *
     * @return mixed
     * @internal User ORM can perform this task
     */
    public function searchUserRequest()
    {
        try {
            $query = $this->db->prepare($this->sql['select']['all']);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return json_encode($e->getMessage());
        }
    }
    /**
     * Find user by user_id
     *
     * @param $id
     * @return mixed
     */
    public function findUserByID(int $id) {
        try {
            $sth = $this->db->prepare($this->sql['select']['by_id']);
            $sth->bindParam(":id", $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch ( PDOException $e ) {
            return $e->getMessage();
        }
    }

	/**
     * Insert new user
     *
	 * @param array $input
	 * @return bool|string
	 */
	public function insertUser( array $input )
    {
		try {
			$stmt = $this->db->prepare( $this->sql['insert']['new_user'] );
			$stmt->bindParam( ":first", $input['first'], PDO::PARAM_STR );
			$stmt->bindParam( ":last", $input['last'], PDO::PARAM_STR );
            $stmt->bindParam( ":password", $input['password'], PDO::PARAM_STR );
			$stmt->bindParam( ":email", $input['email'], PDO::PARAM_STR );
			$stmt->execute();
			return true;
		} catch ( PDOException $e ) {
			return $e->getMessage();
		}
	}

    /**
     * Find user by user_id
     *
     * @param $id
     * @return mixed
     */
    public function deleteUserByID(int $id) {
        try {
            $sth = $this->db->prepare($this->sql['select']['by_id']);
            $sth->bindParam(":id", $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch ( PDOException $e ) {
            return $e->getMessage();
        }
    }

    /**
     * Find user by user_id
     *
     * @param $id
     * @return mixed
     */
    public function editUserByID($array) {
        try {
            $sth = $this->db->prepare($this->sql['select']['by_id']);
            $sth->bindParam(":id", $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch ( PDOException $e ) {
            return $e->getMessage();
        }
    }
}