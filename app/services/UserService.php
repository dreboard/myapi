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

    protected const MIN_ACCOUNT_NUM = 1901;

    public function __construct()
    {
        parent::__construct();
        $this->user_model = new User();
        $this->userdao = new UserDAO();
    }

    public function validateStr(string $input)
    {
        if(filter_var($input, FILTER_SANITIZE_STRING)){
            return $input;
        }
        return false;
    }


}