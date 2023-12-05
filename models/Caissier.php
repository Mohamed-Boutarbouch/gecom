<?php

require 'Model.php';

class Caissier extends Model
{
  public const TABLE_NAME = 'caissier';
  public const SECTION = 'caissiers';
  public const CAPTION = 'La liste des Caissiers';
  public const COLUMNS = ['id', 'nom complete', 'poste', 'admin'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getCaissiers($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT id, CONCAT(nom, ' ', prenom) AS nom_complete, poste, CASE admin WHEN 1 THEN 'Oui' WHEN 0 THEN 'Non' END AS admin FROM caissier LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getCaissierById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM caissier WHERE id = :id', [
      'id' => $id
    ])->fetch();

    return $this->editFormValues;
  }

  public function createCaissier($nom, $prenom, $poste, $admin)
  {
    $this->db->query('INSERT INTO caissier(nom, prenom, poste, admin) VALUES (:nom, :prenom, :poste, :admin)', [
      'nom' => $nom,
      'prenom' => $prenom,
      'poste' => $poste,
      'admin' => $admin
    ]);
  }

  public function updateCaissier($id, $nom, $prenom, $poste, $admin)
  {
    $this->db->query('UPDATE caissier SET nom = :nom, prenom = :prenom, poste = :poste, admin = :admin WHERE id = :id', [
      'nom' => $nom,
      'prenom' => $prenom,
      'poste' => $poste,
      'admin' => $admin,
      'id' => $id
    ]);
  }

  public function deleteCaissier($id)
  {
    $this->db->query('DELETE FROM caissier WHERE id = :id', [
      'id' => $id
    ]);
  }
}
