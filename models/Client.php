<?php

class Client
{
  public const SECTION = 'clients';
  public const CAPTION = 'La liste des clients';

  public function __construct(private $db)
  {
    //
  }

  public function extractColumnNames($excludeIdField = false)
  {
    $tableStructure = $this->db->query('DESCRIBE client')->fetchAll();

    $fieldValues = [];

    foreach ($tableStructure as $tableColumn) {
      $fieldName = $tableColumn["Field"];

      if (!$excludeIdField || $fieldName !== 'id') {
        $fieldValues[] = $fieldName;
      }
    }

    return $fieldValues;
  }

  public function getTotalClientCount()
  {
    return $this->db->query("SELECT COUNT(*) FROM client")->fetchColumn();
  }

  public function getAllClients($page = 1, $perPage = 10)
  {
    $offset = ($page - 1) * $perPage;
    $query = "SELECT id, CONCAT(nom, ' ', prenom) AS nom_complet, adresse, ville FROM client LIMIT $perPage OFFSET $offset";
    return $this->db->query($query)->fetchAll();
  }

  public function getClientById($id)
  {
    return $this->db->query('SELECT * FROM client WHERE id = :id', [
      'id' => $id
    ])->fetch();
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
