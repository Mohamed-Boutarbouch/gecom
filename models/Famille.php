<?php

class Famille
{
  public const SECTION = 'familles';
  public const CAPTION = 'La liste des familles';

  public function __construct(private $db)
  {
    //
  }

  public function extractColumnNames($excludeIdField = false)
  {
    $tableStructure = $this->db->query('DESCRIBE famille')->fetchAll();

    $fieldValues = [];

    foreach ($tableStructure as $tableColumn) {
      $fieldName = $tableColumn["Field"];

      if (!$excludeIdField || $fieldName !== 'id') {
        $fieldValues[] = $fieldName;
      }
    }

    return $fieldValues;
  }

  public function getAllFamilles()
  {
    return $this->db->query('SELECT * FROM famille')->fetchAll();
  }

  public function getFamilleById($id)
  {
    return $this->db->query('SELECT * FROM famille WHERE id = :id', [
      'id' => $id
    ])->fetch();
  }

  public function createFamille($famille)
  {
    $this->db->query('INSERT INTO famille(famille) VALUES (:famille)', [
      'famille' => $famille
    ]);
  }

  public function updateFamille($id, $famille)
  {
    $this->db->query('UPDATE famille SET famille = :famille WHERE id = :id', [
      'famille' => $famille,
      'id' => $id
    ]);
  }

  public function deleteFamille($id)
  {
    $this->db->query('DELETE FROM famille WHERE id = :id', [
      'id' => $id
    ]);
  }
}
