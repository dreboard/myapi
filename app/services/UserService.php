<?php
namespace App\Services;

use System\BaseService;
use \App\Models\{
    User, UserDAO
};

/**
 * Class UserService
 *
 * @package     App\Services
 * @subpackage  Controllers
 * @since       v0.1.0
 *
 */
class UserService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
        //$this->user_model = new User();
        //$this->user_service = new UserService();
        //$this->userdao = new UserDAO();
    }


}