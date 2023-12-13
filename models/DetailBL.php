<?php

require 'Model.php';

class DetailBL extends Model
{
  public const TABLE_NAME = 'BonLivraison';
  public const SECTION = 'detail-bl';
  public const CAPTION = 'La liste des bons_livraisons';
  public const COLUMNS = ['id', 'designation', 'quantite', 'prix', 'total'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getDetailBL($blId)
  {
    return $this->db->query('SELECT A.id, A.designation, DBL.qte, A.prix_ht + (A.prix_ht * A.tva) AS prix, (A.prix_ht + (A.prix_ht * A.tva)) * DBL.qte AS total FROM article A JOIN detail_bl DBL ON A.id = DBL.article_id WHERE DBL.bl_id = :bl_id', [
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


  // public function searchProduct($productName)
  // {
  //   return $this->db->query('SELECT A.id, A.designation, DBL.qte, A.prix_ht + (A.prix_ht * A.tva) AS prix, (A.prix_ht + (A.prix_ht * A.tva)) * DBL.qte AS total FROM detail_bl DBL JOIN article A ON A.id = DBL.article_id WHERE A.designation LIKE :productName ORDER BY A.id LIMIT 10', [
  //     'productName' => '%' . $productName . '%'
  //   ])->fetchAll();
  // }
}
