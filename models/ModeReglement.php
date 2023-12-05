<?php

require 'Model.php';

class ModeReglement extends Model
{
  public const TABLE_NAME = 'mode_reglement';
  public const SECTION = 'modes_reglement';
  public const CAPTION = 'La liste des modes_reglement';
  public const COLUMNS = ['id', 'mode reglement'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getModesReglement($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT * FROM mode_reglement LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getModeReglementById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM mode_reglement WHERE id = :id', [
      'id' => $id
    ])->fetch();

    return $this->editFormValues;
  }

  public function createModeReglement($mode)
  {
    $this->db->query('INSERT INTO mode_reglement(mode) VALUES (:mode)', [
      'mode' => $mode
    ]);
  }

  public function updateModeReglement($id, $mode)
  {
    $this->db->query('UPDATE mode_reglement SET mode = :mode WHERE id = :id', [
      'mode' => $mode,
      'id' => $id
    ]);
  }

  public function deleteModeReglement($id)
  {
    $this->db->query('DELETE FROM mode_reglement WHERE id = :id', [
      'id' => $id
    ]);
  }
}
