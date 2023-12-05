<?php

require 'Model.php';

class BonLivraison extends Model
{
  public const TABLE_NAME = 'BonLivraison';
  public const SECTION = 'bons_livraisons';
  public const CAPTION = 'La liste des bons_livraisons';
  public const COLUMNS = ['id', 'date', 'regle', 'nom client', 'nom caissier', 'poste caissier', 'admin'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getBonsLivraisons($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT bl.id, bl.date, CASE bl.regle WHEN 1 THEN 'Oui' WHEN 0 THEN 'Non' END AS regle, CONCAT(cl.nom, ' ', cl.prenom) AS nom_client, CONCAT(ca.nom, ' ', ca.prenom) AS nom_caissier, ca.poste, CASE ca.admin WHEN 1 THEN 'Oui' WHEN 0 THEN 'Non' END AS admin FROM BonLivraison bl JOIN client cl ON bl.client_id = cl.id JOIN caissier ca ON bl.caissier_id = ca.id ORDER BY bl.id LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getBonLivraisonById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM BonLivraison WHERE id = :id', [
      'id' => $id
    ])->fetch();

    $this->editFormValues['relationships']['client_id'] = $this->clients();
    $this->editFormValues['relationships']['caissier_id'] = $this->caissiers();

    return $this->editFormValues;
  }

  public function createBonLivraison($date, $regle, $clientId, $caissierId)
  {
    $this->db->query('INSERT INTO BonLivraison(date, regle, client_id, caissier_id) VALUES (:date, :regle, :client_id, :caissier_id)', [
      'date' => $date,
      'regle' => $regle,
      'client_id' => $clientId,
      'caissier_id' => $caissierId
    ]);
  }

  public function updateBonLivraison($id, $date, $regle, $clientId, $caissierId)
  {
    $this->db->query('UPDATE BonLivraison SET date = :date, regle = :regle, client_id = :client_id, caissier_id = :caissier_id WHERE id = :id', [
      'date' => $date,
      'regle' => $regle,
      'client_id' => $clientId,
      'caissier_id' => $caissierId,
      'id' => $id
    ]);
  }

  public function deleteBonLivraison($id)
  {
    $this->db->query('DELETE FROM BonLivraison WHERE id = :id', [
      'id' => $id
    ]);
  }

  private function clients()
  {
    return $this->db->query('SELECT id, CONCAT(nom, \' \', prenom) AS name FROM client')->fetchAll();
  }

  private function caissiers()
  {
    return $this->db->query('SELECT id, CONCAT(nom, \' \', prenom) AS name FROM caissier')->fetchAll();
  }

  public function getFieldNamesWithRelationships()
  {

    $this->getFormInputNames = self::getTableFieldNames(true);

    $this->getFormInputNames['relationships']['client_id'] = $this->clients();
    $this->getFormInputNames['relationships']['caissier_id'] = $this->caissiers();

    return $this->getFormInputNames;
  }
}
