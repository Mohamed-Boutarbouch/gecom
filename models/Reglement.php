<?php

require 'Model.php';

class Reglement extends Model
{
  public const TABLE_NAME = 'reglement';
  public const SECTION = 'reglements';
  public const CAPTION = 'La liste des reglements';
  public const COLUMNS = ['id', 'mode reglement', 'regle', 'montant', 'date reglement', 'date bon livraison'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getReglements($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT r.id, mr.mode, CASE bl.regle WHEN 1 THEN 'Oui' WHEN 0 THEN 'Non' END AS regle, r.montant, r.date AS date_reglement, bl.date AS date_bon_livraison FROM reglement r JOIN BonLivraison bl ON r.bl_id = bl.id JOIN mode_reglement mr ON r.mode_id = mr.id ORDER BY r.id LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getReglementById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM reglement WHERE id = :id', [
      'id' => $id
    ])->fetch();

    $this->editFormValues['relationships']['bl_id'] = $this->bonsLivraisons();
    $this->editFormValues['relationships']['mode_id'] = $this->modesReglement();

    return $this->editFormValues;
  }

  public function createReglement($date, $montant, $blId, $modeId)
  {
    $this->db->query('INSERT INTO reglement(date, montant, bl_id, mode_id) VALUES (:date, :montant, :bl_id, :mode_id)', [
      'date' => $date,
      'montant' => $montant,
      'bl_id' => $blId,
      'mode_id' => $modeId
    ]);
  }

  public function updateReglement($id, $date, $montant, $blId, $modeId)
  {
    $this->db->query('UPDATE reglement SET date = :date, montant = :montant, bl_id = :bl_id, mode_id = :mode_id WHERE id = :id', [
      'date' => $date,
      'montant' => $montant,
      'bl_id' => $blId,
      'mode_id' => $modeId,
      'id' => $id
    ]);
  }

  public function deleteReglement($id)
  {
    $this->db->query('DELETE FROM reglement WHERE id = :id', [
      'id' => $id
    ]);
  }

  private function bonsLivraisons()
  {
    return $this->db->query("SELECT bl.id, CONCAT('Client: ', cl.nom, ' ', cl.prenom, ', Caissier: ', ca.nom, ' ', ca.prenom, ', Date: ', bl.date) AS name FROM BonLivraison bl JOIN client cl ON cl.id = bl.client_id JOIN caissier ca ON ca.id = bl.caissier_id ORDER BY bl.id")->fetchAll();
  }

  private function modesReglement()
  {
    return $this->db->query('SELECT id, mode AS name FROM mode_reglement')->fetchAll();
  }

  public function getFieldNamesWithRelationships()
  {
    $this->getFormInputNames = self::getTableFieldNames(true);

    $this->getFormInputNames['relationships']['bl_id'] = $this->bonsLivraisons();
    $this->getFormInputNames['relationships']['mode_id'] = $this->modesReglement();

    return $this->getFormInputNames;
  }
}
