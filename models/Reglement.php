<?php

class Reglement
{
  public const SECTION = 'reglements';
  public const CAPTION = 'La liste des reglements';

  public function __construct(private $db)
  {
    //
  }

  public function extractColumnNames($excludeIdField = false)
  {
    $tableStructure = $this->db->query('DESCRIBE reglement')->fetchAll();

    $fieldValues = [];

    foreach ($tableStructure as $tableColumn) {
      $fieldName = $tableColumn["Field"];

      if (!$excludeIdField || $fieldName !== 'id') {
        $fieldValues[] = $fieldName;
      }
    }

    return $fieldValues;
  }

  public function getTotalReglementCount()
  {
    return $this->db->query('SELECT COUNT(*) FROM reglement')->fetchColumn();
  }

  public function getAllReglements($page = 1, $perPage = 10)
  {
    $offset = ($page - 1) * $perPage;
    $query = "SELECT r.id, mr.mode, bl.regle, r.montant, r.date AS date_reglement, bl.date AS date_bon_livraison FROM reglement r JOIN BonLivraison bl ON r.bl_id = bl.id JOIN mode_reglement mr ON r.mode_id = mr.id ORDER BY r.id LIMIT $perPage OFFSET $offset";
    return $this->db->query($query)->fetchAll();
  }

  public function getReglementById($id)
  {
    return $this->db->query('SELECT r.id, mr.mode, bl.regle, r.montant, r.date FROM reglement r JOIN BonLivraison bl ON r.bl_id = bl.id JOIN mode_reglement mr ON r.mode_id = mr.id WHERE r.id = :id', [
      'id' => $id
    ])->fetch();
  }

  public function createReglement($date, $montant, $blId, $modeId)
  {
    $this->db->query('INSERT INTO reglement(date, montant, bl_id, mode_id) VALUES (:date, :montant, :bl_id, :mode_id', [
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
}
