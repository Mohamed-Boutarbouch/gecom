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

  public function getTotalFamilleCount()
  {
    return $this->db->query("SELECT COUNT(*) FROM famille")->fetchColumn();
  }

  public function getAllFamilles($page = 1, $perPage = 10)
  {
    $offset = ($page - 1) * $perPage;
    $query = "SELECT * FROM famille LIMIT $perPage OFFSET $offset";
    return $this->db->query($query)->fetchAll();
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

  public function getFamilleSelectOptions()
  {
    return $this->db->query('SELECT id, famille AS name FROM famille')->fetchAll();
  }
}
