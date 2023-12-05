<?php

require 'Model.php';

class Article extends Model
{
  public const TABLE_NAME = 'article';
  public const SECTION = 'articles';
  public const CAPTION = 'La liste des Articles';
  public const COLUMNS = ['id', 'designation', 'prix hors tax', 'TVA', 'stock', 'famille'];

  protected function getTableName(): string
  {
    return static::TABLE_NAME;
  }

  public function getArticles($page, $totalRecordsPerPage = 10)
  {
    $offset = ($page - 1) * $totalRecordsPerPage;

    $query = "SELECT a.id, a.designation, a.prix_ht, CONCAT(ROUND(a.tva * 100), '%') AS tva, a.stock, f.famille FROM article a JOIN famille f ON a.famille_id = f.id ORDER BY a.id LIMIT $totalRecordsPerPage OFFSET $offset";

    $this->paginate($page, $totalRecordsPerPage);

    $this->displayDataCollection['collection'] = $this->db->query($query)->fetchAll();

    return $this->displayDataCollection;
  }

  public function getArticleById($id)
  {
    $this->editFormValues['data'] = $this->db->query('SELECT * FROM article WHERE id = :id', [
      'id' => $id
    ])->fetch();

    $this->editFormValues['relationships']['famille_id'] = $this->familles();

    return $this->editFormValues;
  }

  public function createArticle($designation, $prixHt, $tva, $stock, $familleId)
  {
    $this->db->query('INSERT INTO article(designation, prix_ht, tva, stock, famille_id) VALUES (:designation, :prix_ht, :tva, :stock, :famille_id)', [
      'designation' => $designation,
      'prix_ht' => $prixHt,
      'tva' => $tva,
      'stock' => $stock,
      'famille_id' => $familleId
    ]);
  }

  public function updateArticle($id, $designation, $prixHt, $tva, $stock, $familleId)
  {
    $this->db->query('UPDATE article SET designation = :designation, prix_ht = :prix_ht, tva = :tva, stock = :stock, famille_id = :famille_id WHERE id = :id', [
      'designation' => $designation,
      'prix_ht' => $prixHt,
      'tva' => $tva,
      'stock' => $stock,
      'famille_id' => $familleId,
      'id' => $id
    ]);
  }

  public function deleteArticle($id)
  {
    $this->db->query('DELETE FROM article WHERE id = :id', [
      'id' => $id
    ]);
  }

  private function familles()
  {
    return $this->db->query('SELECT id, famille AS name FROM famille')->fetchAll();
  }

  public function getFieldNamesWithRelationships()
  {
    $this->getFormInputNames = self::getTableFieldNames(true);

    $this->getFormInputNames['relationships']['famille_id'] = $this->familles();

    return $this->getFormInputNames;
  }
}
