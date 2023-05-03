<?php

namespace App;

use PDO;

class User
{
	protected $id;
	protected $first_name;
	protected $middle_name;
	protected $last_name;
	protected $email;
	protected $birthdate;
	protected $gender;
	protected $address;
	protected $contact_number;
	protected $pass;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getFullName()
	{
		return $this->first_name . $this->middle_name . $this->last_name;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getMiddleName()
	{
		return $this->middle_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function getContactNumber()
	{
		return $this->contact_number;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\User');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function hashPassword($password)
	{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		return $hashed_password;
	}

	public static function attemptLogin($email, $pass)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE email=:email
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'email' => $email,
				//'pass' => $password
			]);
			$user = $statement->fetchObject('App\User');

			// Use password_verify() function to verify the hashed password with the input password
			if ($user && password_verify($pass, User::hashPassword($pass))) {
					$pass = User::hashPassword($pass);
					return $user;
			}
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($first_name, $middle_name, $last_name, $gender, $birthdate, $address, $contact_number, $email, $password)
	{
		global $conn;

		try {
			// Hash the password before inserting it to DB
			$hashed_password = self::hashPassword($password);

			$sql = "
				INSERT INTO users (first_name, middle_name, last_name, gender, birthdate, address, contact_number, email, pass)
				VALUES ('$first_name', '$middle_name', '$last_name', '$gender', '$birthdate', '$address', '$contact_number', '$email', '$hashed_password')
			";
			$conn->exec($sql);
			
			// echo "<li>Executed SQL query " . $sql;
			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {

				$sql = "
					INSERT INTO users
					SET
						first_name=\"{$user['first_name']}\",
						middle_name=\"{$user['middle_name']}\",
						last_name=\"{$user['last_name']}\",
						gender=\"{$user['gender']}\",
						birthdate=\"{$user['birthdate']}\",
						address=\"{$user['address']}\",
						contact_number=\"{$user['contact_number']}\",
						email=\"{$user['email']}\",
						pass=\"{$user['pass']}\"
				";
				$conn->exec($sql);
				// echo "<li>Executed SQL query " . $sql;
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}