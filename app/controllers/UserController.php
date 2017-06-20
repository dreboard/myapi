<?php
namespace App\Controllers;
/**
 * MyAPI user class.
 *
 * @package     MyAPI\Application
 * @subpackage  Controllers
 * @author      Andre Board
 * @version     v0.1.0
 * @since       0.1.0
 *
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \PDO;
use \PDOException;
use \App\Models\User;

class UserController extends \System\BaseController{

    public $user_model;

	public function __construct($c)
	{
		parent::__construct($c);
		$this->user_model = new User();
	}

    /**
	 * @param Request $request
	 * @param Response $response
	 * @param $args
	 *
	 * @internal param int $id
	 */
	public function find_user(Request $request, Response $response, $args) {
		$sth = $this->db->prepare("SELECT * FROM users WHERE id=:id");
		$sth->bindParam("id", $args['id'], PDO::PARAM_INT);
		$sth->execute();
		$user = $sth->fetchObject();
		return $this->response->withJson($user);
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 *
	 * @return mixed
	 */
	public function get_users(Request $request, Response $response) {
		$sql = "select * FROM users";
		try {
			$stmt = $this->db->query($sql);
			$stmt->execute();
			$user_array = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $response->withStatus(200)->withJson($user_array);
		}
		catch(PDOException $e) {
			echo json_encode($e->getMessage());
		}
	}

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function get_all_users(Request $request, Response $response) {
        try {
            $user_array = $this->user_model::all();
            return $response->withStatus(200)->withJson($user_array);
        }
        catch(\Throwable $e) {
            echo json_encode($e->getMessage());
        }
    }

	/**
	 *
	 * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
	 * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
	 *
	 * @return mixed
	 */
	public function add_user(Request $request, Response $response) {
		$input = $request->getParsedBody();
		if ($input === null) {
			return $response->withJson(
				['error_decoding_json' => json_last_error_msg()],
				400,
				JSON_PRETTY_PRINT
			);
		}
		var_dump($input);exit;

		$first = filter_posts($data['first']);

		$sql = "INSERT INTO users (`name`,`email`,`age`) VALUES (:name, :email, :age)";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam("name", $body->userName);
			$stmt->bindParam("email", $userEmail);
			$stmt->bindParam("age", $userAge);
			$stmt->execute();
			return $response->withStatus(201);
		} catch(\PDOException $e) {
			echo json_encode($e->getMessage());
		}
	}
}