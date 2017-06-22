<?php

namespace App\Controllers;

/**
 * Class UserController
 * @package     App\Controllers
 * @subpackage  Controllers
 * @author      Andre Board
 * @since       v0.1.0
 *
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \App\Models\{
    User, UserDAO
};
use Psr\Log\InvalidArgumentException;
use Slim\Container;

class UserController extends \System\BaseController
{


    /**
     * @var User
     */
    protected $user_model;

    /**
     * @var UserDAO
     */
    protected $userdao;

    /**
     * UserController constructor.
     *
     * Instantiate new user models
     * @param Container Object $c
     *
     * @codeCoverageIgnore
     */
    public function __construct($c)
    {
        parent::__construct($c);
        $this->user_model = new User();
        $this->userdao = new UserDAO();
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     *
     * @internal param int $id
     */
    public function findUserRequest(Request $request, Response $response, $args)
    {
        try {
            $id = $args['id'];
            if(!$id){
                throw new \InvalidArgumentException($this->lang['invalid_id']);
            }
            $user = $this->userdao->findUserByID($id);
            if ($user) {
                return $response->withStatus(200)->withJson($user);
            } else {
                throw new \Exception($this->lang['valid_user']);
            }
        } catch (\Throwable $e) {
            return $response->withStatus(201)->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => $e->getMessage(),
                    'php_file' => $e->getFile() . ' ' . $e->getLine()
                ],
                400,
                JSON_PRETTY_PRINT
            );
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function get_users(Request $request, Response $response)
    {
        $sql = "select * FROM users";
        try {
            $stmt = $this->db->query($sql);
            $stmt->execute();
            $user_array = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $response->withStatus(200)->withJson($user_array);
        } catch (PDOException $e) {
            echo json_encode($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function getAllUsers(Request $request, Response $response)
    {
        try {
            $user_array = $this->user_model::all();
            return $response->withStatus(200)->withJson($user_array);
        } catch (\Throwable $e) {
            return $response->withStatus(201)->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => $e->getMessage(),
                    'php_file' => $e->getFile() . ' ' . $e->getLine()
                ],
                400,
                JSON_PRETTY_PRINT
            );
        }
    }

    /**
     * Add new user to the database
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
     *
     * @return mixed
     */
    public function addUserRequest(Request $request, Response $response)
    {

        try {
            if ($this->userdao->insertUser($request->getParsedBody())) {
                return $response->withStatus(201)->withJson([
                    'status' => 'success',
                    'errors' => 'none']);
            }
        } catch (\Throwable $e) {
            return $response->withStatus(200)->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => $e->getMessage(),
                    'php_file' => $e->getFile() . ' ' . $e->getLine(),
                    'api_msg'       => 'None'
                ],
                400,
                JSON_PRETTY_PRINT
            );
        }
    }

	/**
	 * Remove user by ID
	 *
	 * @param Request $request
	 * @param Response $response
	 * @param $args
	 *
	 * @internal 405 response sent to client
	 */
	public function deleteUserRequest(Request $request, Response $response, $args)
	{
		if(false == $request->isDelete()){
			return $response->withJson(
				[
					'json_errors'   => json_last_error_msg(),
					'php_errors'    => 'none',
					'php_file'      => __CLASS__.' '.__LINE__,
					'api_msg'       => 'Method must be DELETE'
				],
				405,
				JSON_PRETTY_PRINT
			);
		}
		try {
			$id = $args['id'];
			if(!$id){
				throw new \InvalidArgumentException($this->lang['invalid_id']);
			}
			$user = $this->userdao->findUserByID($id);
			if ($user) {
				return $response->withStatus(200)->withJson($user);
			} else {
				throw new \Exception($this->lang['valid_user']);
			}
		} catch (\Throwable $e) {
			return $response->withStatus(201)->withJson(
				[
					'json_errors' => json_last_error_msg(),
					'php_errors' => $e->getMessage(),
					'php_file' => $e->getFile() . ' ' . $e->getLine(),
					'api_msg'       => 'None'
				],
				400,
				JSON_PRETTY_PRINT
			);
		}
	}
}
