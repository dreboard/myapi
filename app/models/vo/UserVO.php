<?php

namespace App\Models;

use \MyApiCore\System\BaseModel;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Class UserVO
 * User Value Object
 *
 * @package     App\Models
 * @subpackage  Controllers
 * @since       v0.1.0
 *
 */
class UserVO extends BaseModel
{

    public $id;
    public $first;
    public $last;
    public $email;
	public $created;

    /**
     * UserDAO constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     *
     */
    public function getFullname()
    {
        echo $this->firstname . ' ' . $this->lastname;
    }
}