<?php

require 'Model.php';

class DetailBL extends Model
{
  public const TABLE_NAME = 'detail_bl';
  public const SECTION = 'detail-bl';
  public const CAPTION = 'La liste des bons_livraisons';
  public const COLUMNS = ['id', 'designation', 'quantite', 'prix', 'total'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getDetailBL($blId)
  {
    return $this->db->query('SELECT DBL.id, A.designation, DBL.qte, A.prix_ht + (A.prix_ht * A.tva) AS prix, (A.prix_ht + (A.prix_ht * A.tva)) * DBL.qte AS total FROM article A JOIN detail_bl DBL ON A.id = DBL.article_id WHERE DBL.bl_id = :bl_id', [
      'bl_id' => $blId
    ])->fetchAll();
  }

  public function getTotalPrice($blId)
  {
    return $this->db->query('SELECT SUM((A.prix_ht + (A.prix_ht * A.tva)) * DBL.qte) AS total FROM article A JOIN detail_bl DBL ON A.id = DBL.article_id WHERE DBL.bl_id = :bl_id', [
      'bl_id' => $blId
    ])->fetchColumn();
  }

  public function increaseQuantity($id)
  {
    $this->db->query('UPDATE detail_bl SET qte = qte + 1 WHERE id = :id', [
      'id' => $id
    ]);
  }

  public function decreaseQuantity($id)
  {
    $this->db->query('UPDATE detail_bl SET qte = qte - 1 WHERE id = :id', [
      'id' => $id
    ]);
  }

  private function articles()
  {
    return $this->db->query('SELECT id, designation AS name FROM article')->fetchAll();
  }

  public function getFieldNamesWithRelationships()
  {

    $this->getFormInputNames = self::getTableFieldNames(true);

    $this->getFormInputNames['relationships']['article_id'] = $this->articles();

    return $this->getFormInputNames;
  }

  public function storeDetailBL($articleId, $blId, $qte)
  {
    $this->db->query('INSERT INTO detail_bl (article_id , bl_id , qte) VALUES(:article_id, :bl_id, :qte)', [
      'article_id' => $articleId,
      'bl_id' => $blId,
      'qte' => $qte
    ]);
  }

  public function deleteDetailBL($id)
  {
    $this->db->query('DELETE FROM detail_bl WHERE id = :id', [
      'id' => $id
    ]);
  }

  public function finalTotal($blId)
  {
    return $this->db->query('SELECT SUM((A.prix_ht + (A.prix_ht * A.tva)) * DBL.qte) AS finalTotal FROM article A JOIN detail_bl DBL ON A.id = DBL.article_id WHERE DBL.bl_id = :bl_id', [
      'bl_id' => $blId
    ])->fetchColumn();
  }
}
