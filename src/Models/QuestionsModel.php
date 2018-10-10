<?php

namespace Oquiz\Models;

use Oquiz\Utils\Database;
use PDO;


class QuestionsModel extends BaseModel
{
  /**
  * @var int
  */
  private $id_quiz;
  /**
   * @var string
   */
  private $question;
  /**
   * @var string
   */
  private $prop1;
  /**
   * @var string
   */
  private $prop2;
  /**
   * @var string
   */
  private $prop3;
  /**
   * @var string
   */
  private $prop4;
  /**
   * @var int
   */
  private $id_level;
  /**
   * @var string
   */
  private $anecdote;
  /**
   * @var string
   */
  private $wiki;


  const TABLE_NAME = 'questions';

  /* MÉTHODES */

  // Pour mélangé les différentes valeurs
  public function shuffleProp()
  {
    $propShuffle = [$this->prop1, $this->prop2, $this->prop3, $this->prop4];
    shuffle($propShuffle);
    return $propShuffle;
  }
    
  protected function insert()
  {
        // TODO
  }

  protected function update()
  {
        // TODO
  }

	// Retourne toutes les questions contenu dans un quiz en fonction de l'ID
  public static function findAllQuestionsByQuizId(int $id)
  {
    $sql = 'SELECT *
						FROM ' . static::TABLE_NAME . '
						WHERE id_quiz = :id
        ';
    $pdoStatement = Database::getPDO()->prepare($sql);

    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

    $pdoStatement->execute();

    return $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
	}
	
	// Retourne le nombre de questions contenu dans un quiz en fonction de l'ID
	public static function countAllQuestions(int $id)
	{
		$sql = 'SELECT COUNT(*)
						FROM ' . static::TABLE_NAME . '
						WHERE id_quiz = :id
        ';
		$pdoStatement = Database::getPDO()->prepare($sql);

		$pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

		$pdoStatement->execute();

		return $pdoStatement->fetch(PDO::FETCH_ASSOC);
	}
  
  /* GETTER ET SETTER */
	/** 
	 * Get the value of id_quiz
	 * @return  int
	 */
	public function getId_quiz() : int
	{
		return $this->id_quiz;
	}

	/**
	 * Set the value of id_quiz
	 *
	 * @param   int  $id_quiz  
	 *
	 * @return  self
	 */
	public function setId_quiz(int $id_quiz)
	{
		if (!empty($id_quiz)) {
		$this->id_quiz = $id_quiz;
		}
		return $this;
	}

	/** 
	 * Get the value of question
	 * @return  string
	 */
	public function getQuestion() : string
	{
		return $this->question;
	}

	/**
	 * Set the value of question
	 *
	 * @param   string  $question  
	 *
	 * @return  self
	 */
	public function setQuestion(string $question)
	{
		if (!empty($question)) {
		$this->question = $question;
		}
		return $this;
	}

	/** 
	 * Get the value of prop1
	 * @return  string
	 */
	public function getProp1() : string
	{
		return $this->prop1;
	}

	/**
	 * Set the value of prop1
	 *
	 * @param   string  $prop1  
	 *
	 * @return  self
	 */
	public function setProp1(string $prop1)
	{
		if (!empty($prop1)) {
		$this->prop1 = $prop1;
		}
		return $this;
	}

	/** 
	 * Get the value of prop2
	 * @return  string
	 */
	public function getProp2() : string
	{
		return $this->prop2;
	}

	/**
	 * Set the value of prop2
	 *
	 * @param   string  $prop2  
	 *
	 * @return  self
	 */
	public function setProp2(string $prop2)
	{
		if (!empty($prop2)) {
		$this->prop2 = $prop2;
		}
		return $this;
	}

	/** 
	 * Get the value of prop3
	 * @return  string
	 */
	public function getProp3() : string
	{
		return $this->prop3;
	}

	/**
	 * Set the value of prop3
	 *
	 * @param   string  $prop3  
	 *
	 * @return  self
	 */
	public function setProp3(string $prop3)
	{
		if (!empty($prop3)) {
		$this->prop3 = $prop3;
		}
		return $this;
	}

	/** 
	 * Get the value of prop4
	 * @return  string
	 */
	public function getProp4() : string
	{
		return $this->prop4;
	}

	/**
	 * Set the value of prop4
	 *
	 * @param   string  $prop4  
	 *
	 * @return  self
	 */
	public function setProp4(string $prop4)
	{
		if (!empty($prop4)) {
		$this->prop4 = $prop4;
		}
		return $this;
	}

	/** 
	 * Get the value of id_level
	 * @return  int
	 */
	public function getId_level() : int
	{
		return $this->id_level;
	}

	/**
	 * Set the value of id_level
	 *
	 * @param   int  $id_level  
	 *
	 * @return  self
	 */
	public function setId_level(int $id_level)
	{
		if (!empty($id_level)) {
		$this->id_level = $id_level;
		}
		return $this;
	}

	/** 
	 * Get the value of anecdote
	 * @return  string
	 */
	public function getAnecdote() : string
	{
		return $this->anecdote;
	}

	/**
	 * Set the value of anecdote
	 *
	 * @param   string  $anecdote  
	 *
	 * @return  self
	 */
	public function setAnecdote(string $anecdote)
	{
		if (!empty($anecdote)) {
		$this->anecdote = $anecdote;
		}
		return $this;
	}

	/** 
	 * Get the value of wiki
	 * @return  string
	 */
	public function getWiki() : string
	{
		return $this->wiki;
	}

	/**
	 * Set the value of wiki
	 *
	 * @param   string  $wiki  
	 *
	 * @return  self
	 */
	public function setWiki(string $wiki)
	{
		if (!empty($wiki)) {
		$this->wiki = $wiki;
		}
		return $this;
	}
}