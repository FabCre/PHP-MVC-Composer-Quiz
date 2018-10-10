<?php

namespace Oquiz\Models;

use Oquiz\Utils\Database;
use PDO;

class QuizzesModel extends BaseModel
{
  /**
   * @var string
   */
  private $title;
  /**
   * @var string
   */
  private $description;
  /**
   * @var int
   */
  private $id_author;
  
  // Déclaration d'une constante à utiliser dans les méthodes
  const TABLE_NAME = 'quizzes';

  /* MÉTHODES */

  protected function insert()
  {
        // TODO
  }

  protected function update()
  {
        // TODO
	}

  /* GETTER ET SETTER */

  /** 
	 * Get the value of title
	 * @return  string
	 */
	public function getTitle() : string
	{
		return $this->title;
	}

	/**
	 * Set the value of title
	 *
	 * @param   string  $title  
	 *
	 * @return  self
	 */
	public function setTitle(string $title)
	{
		if (!empty($title)) {
		$this->title = $title;
		}
		return $this;
	}

	/** 
	 * Get the value of description
	 * @return  string
	 */
	public function getDescription() : string
	{
		return $this->description;
	}

	/**
	 * Set the value of description
	 *
	 * @param   string  $description  
	 *
	 * @return  self
	 */
	public function setDescription(string $description)
	{
		if (!empty($description)) {
		$this->description = $description;
		}
		return $this;
	}

	/** 
	 * Get the value of id_author
	 * @return  int
	 */
	public function getId_author() : int
	{
		return $this->id_author;
	}

	/**
	 * Set the value of id_author
	 *
	 * @param   int  $id_author  
	 *
	 * @return  self
	 */
	public function setId_author(int $id_author)
	{
		if (!empty($id_author)) {
		$this->id_author = $id_author;
		}
		return $this;
	}
}