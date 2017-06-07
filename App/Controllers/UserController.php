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
use \System\BaseController;
use \PDO;
use \PDOException;
use \PDOStatement;

class UserController extends BaseController{

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
	public function get_all_users(Request $request, Response $response) {
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
	 *
	 */
	public function add_user(Request $request, Response $response) {
		global $app;
		$req = $app->request();
		$body = json_decode($req->getBody());

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