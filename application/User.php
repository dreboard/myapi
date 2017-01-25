<?php
namespace MyAPI\Application;
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 1/24/2017
 * Time: 10:54 PM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class User {

	public static function getConnection() {
		$dbhost="127.0.0.1";
		$dbuser="root";
		$dbpass="";
		$dbname="myapi";
		$dbh = new \PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}
	/**
	 *
	 */
	public static function getUsers() {
		$sql = "select * FROM users";
		try {
			$db = SELF::getConnection();
			$stmt = $db->query($sql);
			$users = $stmt->fetchAll(\PDO::FETCH_OBJ);
			$db = null;
			return $users;
			//echo json_encode($users);
		}
		catch(\PDOException $e) {
			echo json_encode($e->getMessage());
		}
	}


	/**
	 *
	 */
	public static function addUser() {
		global $app;
		$req = $app->request();
		$body = json_decode($req->getBody());

		$sql = "INSERT INTO users (`name`,`email`,`age`) VALUES (:name, :email, :age)";
		try {
			$db = SELF::getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $body->userName);
			$stmt->bindParam("email", $userEmail);
			$stmt->bindParam("age", $userAge);
			$stmt->execute();
			$db = null;
			echo json_encode($user);
		} catch(\PDOException $e) {
			echo json_encode($e->getMessage());
		}
	}


	/**
	 * @param $id
	 */
	public static function updateUser($id) {
		global $app;
		$req = $app->request();
		$body = json_decode($request->getBody());

		$sql = "UPDATE users SET email=:email, age=:age WHERE id=:id";
		try {
			$db = SELF::getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("email", $body->email);
			$stmt->bindParam("age", $body->age);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			echo json_encode($body);
		} catch(\PDOException $e) {
			echo json_encode($e->getMessage());
		}
	}


	/**
	 * @param $id
	 */
	public static function deleteUser($id) {
		$sql = "DELETE FROM users WHERE id=:id";
		try {
			$db = SELF::getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
		} catch(\PDOException $e) {
			echo json_encode($e->getMessage());
		}
	}

}