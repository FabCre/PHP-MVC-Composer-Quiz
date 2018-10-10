<?php

namespace Oquiz\Models;

use Oquiz\Utils\Database;
use PDO;

class LevelsModel extends BaseModel
{
  /**
   * @var string
   */
  private $name;

  const TABLE_NAME = 'levels';

  /* MÉTHODES */

  protected function insert()
  {
        // TODO
  }

  protected function update()
  {
        // TODO
  }

  // Le level a partir de l'id, retour d'un objet
  public function findQuestionLevelById(int $id)
  {
    $sql = 'SELECT name
            FROM ' . static::TABLE_NAME . '
            INNER JOIN questions
							ON levels.id = questions.id_level
						WHERE levels.id = :id										
        	';
    $pdoStatement = Database::getPDO()->prepare($sql);

    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

    $pdoStatement->execute();

    return $pdoStatement->fetchObject(static::class);
  }  

  // Retourne un afficahge selon l'id pour obtenir une couleur Bootstrap
  public function displayLevelColor(int $id)
  {
    if ($id == 1)
    {
      echo 'success';
    } else if ($id == 2)
    {
      echo 'warning';
    } else if ($id == 3)
    {
      echo 'danger';
    }
  }

	/** 
	 * Get the value of name
	 * @return  string
	 */
	public function getName() : string
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @param   int  $name  
	 *
	 * @return  self
	 */
	public function setName(int $name)
	{
		if (!empty($name)) {
		$this->name = $name;
		}
		return $this;
	}
}