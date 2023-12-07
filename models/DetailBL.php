<?php

require 'Model.php';

class DetailBL extends Model
{
  public const TABLE_NAME = 'BonLivraison';
  // public const SECTION = 'bons_livraisons';
  // public const CAPTION = 'La liste des bons_livraisons';
  // public const COLUMNS = ['id', 'date', 'regle', 'nom client', 'nom caissier', 'poste caissier', 'admin'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  // public function getDetailsBL($BlId)
  // {
  //   $query = "SELECT DBL.*, BL.date, BL.regle, CONCAT(CL.nom, '', CL.prenom) AS Nom_Client, CONCAT(CA.nom, '', CA.prenom) AS Nom_Caissier, A.* FROM detail_bl DBL JOIN BonLivraison BL ON BL.id = DBL.bl_id JOIN article A ON A.id = DBL.article_id JOIN client CL ON CL.id = BL.client_id JOIN caissier CA ON CA.id = BL.caissier_id WHERE BL.id = $BlId";

  //   return $this->db->query($query)->fetchAll();
  // }

  public function getArticles($id)
  {
    return $this->db->query('SELECT * FROM BonLivraison WHERE id = :id', [
      'id' => $id
    ])->fetch();
  }
}

"SELECT A.id, A.designation, DBL.qte, A.prix_ht + (A.prix_ht * A.tva) AS prix, (A.prix_ht + (A.prix_ht * A.tva)) * DBL.qte AS total FROM detail_bl DBL JOIN article A ON A.id = DBL.article_id ORDER BY A.id LIMIT 10";
