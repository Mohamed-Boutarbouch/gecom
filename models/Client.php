<?php

require 'Model.php';

class Client extends Model
{
  public const TABLE_NAME = 'client';
  public const SECTION = 'clients';
  public const CAPTION = 'La liste des Clients';
  public const COLUMNS = ['id', 'nom complete', 'adresse', 'ville'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getClients($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT id, CONCAT(nom, ' ', prenom) AS nom_complete, adresse, ville FROM client LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getClientById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM client WHERE id = :id', [
      'id' => $id
    ])->fetch();

    return $this->editFormValues;
  }

  public function createClient($nom, $prenom, $adresse, $ville)
  {
    $this->db->query('INSERT INTO client(nom, prenom, adresse, ville) VALUES (:nom, :prenom, :adresse, :ville)', [
      'nom' => $nom,
      'prenom' => $prenom,
      'adresse' => $adresse,
      'ville' => $ville
    ]);
  }

  public function updateClient($id, $nom, $prenom, $adresse, $ville)
  {
    $this->db->query('UPDATE client SET nom = :nom, prenom = :prenom, adresse = :adresse, ville = :ville WHERE id = :id', [
      'nom' => $nom,
      'prenom' => $prenom,
      'adresse' => $adresse,
      'ville' => $ville,
      'id' => $id
    ]);
  }

  public function deleteClient($id)
  {
    $this->db->query('DELETE FROM client WHERE id = :id', [
      'id' => $id
    ]);
  }
}
