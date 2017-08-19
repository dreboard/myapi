<?php

namespace App\Controllers;

/**
 * Class UserController
 * @package     App\Controllers
 * @subpackage  Controllers
 * @since       v0.1.0
 *
 */
use App\Components\GoogleAnalytics as GA;
use MyApiCore\System\{BaseController, GoogleAnalytics};
use App\Services\UserService;
use \Interop\Container\ContainerInterface as ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \App\Models\{
    User, UserDAO
};
use Psr\Log\InvalidArgumentException;
use Slim\Container;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class UserController extends BaseController
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
    public function __construct(ContainerInterface $c)
    {
        parent::__construct($c);
        $this->user_model = new User();
        $this->user_service = new UserService();
        $this->userdao = new UserDAO();
    }

    public function getIP() {
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
			if (array_key_exists($key, $_SERVER) === true) {
				foreach (explode(',', $_SERVER[$key]) as $ip) {
					if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
						return $ip;
					}
				}
			}
		}
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
            $user_array = [
            	$this->userdao->findUserByID($args['id']),
	            'GA' => TRACKING_CODE,
	            'ip' => $request->getServerParam('REMOTE_ADDR'),
	            'url' => preg_replace('/\//', '/', $request->getUri()->getPath()),
	            'route' => $request->getAttribute('route')
            ];
	        GA::gaSendData($url = 'userController/findUser', $user_agent = 'Curl/1.0');
            return $response->withStatus(200)->withJson($user_array);

        } catch (\Throwable $e) {
            //$this->logger->error('API Exception', array('exception' => $e->getMessage()));
            return $response->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => $e->getMessage(),
                    'php_file' => $e->getFile() . ' ' . $e->getLine(),
                    'api_msg' => ''
                ],
                200,
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
        try {
            $user_array = $this->userdao->searchUserRequest();
            return $response->withStatus(200)->withJson($user_array);
        } catch (\Throwable $e) {
            return $response->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => $e->getMessage(),
                    'php_file' => $e->getFile() . ' ' . $e->getLine(),
                    'api_msg' => 'Method must be POST'
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
                    'php_file' => $e->getFile() . ' ' . $e->getLine(),
                    'api_msg' => ''
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
        if (false == $request->isPost()) {
            $this->logger->info('API Message', array('methods' => 'invalid method'));
            return $response->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => 'none',
                    'php_file' => __CLASS__ . ' ' . __LINE__,
                    'api_msg' => ''
                ],
                405,
                JSON_PRETTY_PRINT
            );
        }
        try {
            if ($this->userdao->insertUser($request->getParsedBody())) {
                /** @noinspection PhpUndefinedMethodInspection */
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
                    'api_msg' => 'None'
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
     * @codeCoverageIgnore
     */
    public function deleteUserRequest(Request $request, Response $response, $args)
    {
        if (false == $request->isDelete()) {
            return $response->withJson(
                [
                    'json_errors' => json_last_error_msg(),
                    'php_errors' => 'none',
                    'php_file' => __CLASS__ . ' ' . __LINE__,
                    'api_msg' => 'Method must be DELETE'
                ],
                405,
                JSON_PRETTY_PRINT
            );
        }
        try {
            $id = $args['id'];
            if (!$id) {
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
                    'api_msg' => 'None'
                ],
                400,
                JSON_PRETTY_PRINT
            );
        }
    }
}
