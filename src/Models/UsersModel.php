<?php

namespace Oquiz\Models;

use Oquiz\Utils\Database;
use PDO;


class UsersModel extends BaseModel
{
		/**
		 * @var string
		 */
		private $first_name;
		/**
		 * @var string
		 */
		private $last_name;
		/**
		 * @var string
		 */
		private $email;
		/**
		 * @var string
		 */
		private $password;
		
		const TABLE_NAME = 'users';

 	  /* MÉTHODES */

		// Insertion d'un utilisateur en BDD, retourne true or false selon le nombre de ligne inséré
		protected function insert() : bool
		{
				$sql = 'INSERT INTO ' . self::TABLE_NAME . ' (first_name, last_name, email,password)
								VALUES (:first_name, :last_name, :email, :password)
							';

				$pdoStatement = Database::getPDO()->prepare($sql);

				$pdoStatement->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
				$pdoStatement->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
				$pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
				$pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);

				$pdoStatement->execute();

				$insertedRows = $pdoStatement->rowCount();

				if ($insertedRows > 0) {
					$this->id = Database::getPDO()->lastInsertId();

					return true;
				} else {
							// Retourne false si pas d'insertion ou erreur
					return false;
				}
		}

		protected function update()
		{
					// TODO
		}

		// Tout les quizz en fonction de l'id en paramètre sous forme de tableau
		public static function findUsers($id)
		{
				$sql = 'SELECT *
								FROM ' . static::TABLE_NAME . '
								INNER JOIN quizzes
									ON users.id = quizzes.id_author
								WHERE users.id = :id										
							';
				$pdoStatement = Database::getPDO()->prepare($sql);

				$pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

				$pdoStatement->execute();

				return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		}

		// Un utilisateur selon son email sous forme objet
		public static function findByEmail(string $email)
		{
				$sql = 'SELECT id
								FROM ' . self::TABLE_NAME . '
								WHERE email = :email
							';
				$pdoStatement = Database::getPDO()->prepare($sql);

				$pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);

				$pdoStatement->execute();

				$userId = $pdoStatement->fetchColumn(0);
						
				// Si on a touvé un userId
				if ($userId !== false) {
					// La méthode find hérité retourne l'objet correspondant à l'ID
					$userModel = self::find($userId);
					return $userModel;
				}

				return false;
		}

		/* GETTER ET SETTER */

		/** 
		 * Get the value of first_name
		 * @return  string
		 */
		public function getFirst_name() : string
		{
			return $this->first_name;
		}

		/**
		 * Set the value of first_name
		 *
		 * @param   string  $first_name  
		 *
		 * @return  self
		 */
		public function setFirst_name(string $first_name)
		{
			if (!empty($first_name)) {
			$this->first_name = $first_name;
			}
			return $this;
		}

		/** 
		 * Get the value of last_name
		 * @return  string
		 */
		public function getLast_name() : string
		{
			return $this->last_name;
		}

		/**
		 * Set the value of last_name
		 *
		 * @param   string  $last_name  
		 *
		 * @return  self
		 */
		public function setLast_name(string $last_name)
		{
			if (!empty($last_name)) {
			$this->last_name = $last_name;
			}
			return $this;
		}

		/** 
		 * Get the value of email
		 * @return  string
		 */
		public function getEmail() : string
		{
			return $this->email;
		}

		/**
		 * Set the value of email
		 *
		 * @param   string  $email  
		 *
		 * @return  self
		 */
		public function setEmail(string $email)
		{
			if (!empty($email)) {
			$this->email = $email;
			}
			return $this;
		}

		/** 
		 * Get the value of password
		 * @return  string
		 */
		public function getPassword() : string
		{
			return $this->password;
		}

		/**
		 * Set the value of password
		 *
		 * @param   string  $password  
		 *
		 * @return  self
		 */
		public function setPassword(string $password)
		{
			if (!empty($password)) {
			$this->password = $password;
			}
			return $this;
		}
}
    