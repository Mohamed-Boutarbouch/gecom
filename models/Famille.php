<?php

require 'Model.php';

class Famille extends Model
{
  public const TABLE_NAME = 'famille';
  public const SECTION = 'familles';
  public const CAPTION = 'La liste des Familles';
  public const COLUMNS = ['id', 'famille'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getFamilles($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT id, famille FROM famille LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getFamilleById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM famille WHERE id = :id', [
      'id' => $id
    ])->fetch();

    return $this->editFormValues;
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
