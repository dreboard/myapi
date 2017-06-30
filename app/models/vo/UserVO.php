<?php

namespace App\Models;

use System\BaseModel;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Class UserVO
 * User Data Access Object
 *
 * @package     App\Models
 * @subpackage  Controllers
 * @since       v0.1.0
 *
 */
class UserVO extends BaseModel
{

    protected $first;
    protected $last;
    protected $email;
    private $sql;

    /**
     * UserDAO constructor.
     */
    public function __construct()
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
            $query = $this->dsn->prepare($this->sql['select']['all']);
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
    public function findUserByID(int $id)
    {
        try {
            $sth = $this->dsn->prepare($this->sql['select']['by_id']);
            $sth->bindParam(":id", $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Insert new user
     *
     * @param array $input
     * @return bool|string
     */
    public function insertUser(array $input)
    {
        try {
            $stmt = $this->dsn->prepare($this->sql['insert']['new_user']);
            $stmt->bindParam(":first", $input['first'], PDO::PARAM_STR);
            $stmt->bindParam(":last", $input['last'], PDO::PARAM_STR);
            $stmt->bindParam(":password", $input['password'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $input['email'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Find user by user_id
     *
     * @param $id
     * @return mixed
     */
    public function deleteUserByID(int $id)
    {
        try {
            $sth = $this->dsn->prepare($this->sql['select']['by_id']);
            $sth->bindParam(":id", $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Find user by user_id
     * @return mixed
     * @internal param $array
     * @internal param $id
     */
    public function editUserByID()
    {
        try {
            $sth = $this->dsn->prepare($this->sql['select']['by_id']);
            $sth->bindParam(":id", $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
