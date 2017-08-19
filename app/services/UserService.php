<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
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
    use ResponseHelper;

    protected const MIN_ACCOUNT_NUM = 1901;
    protected $userdao;

    public function __construct()
    {
        parent::__construct();
        $this->user_model = new User();
        $this->userdao = new UserDAO();
    }

    public function validateStr(string $input)
    {
        if (filter_var($input, FILTER_SANITIZE_STRING)) {
            return $input;
        }
        return false;
    }


    /**
     * Process user JSON response
     * @param $id
     * @return array
     */
    public function getUser($id)
    {
        if (!$id) {
            throw new \InvalidArgumentException($this->lang['invalid_id']);
        }
        $user = $this->userdao->findUserByID($id);
        //$responseData = $this->createGetUserLinks($user);
        return $user;
    }


}