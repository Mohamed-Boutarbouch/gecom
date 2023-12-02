<?php

class Article
{
  public const SECTION = 'articles';
  public const CAPTION = 'La liste des articles';
  public const FOREIGN_KEYS = ['famille' => 'famille_id'];

  public function __construct(private $db)
  {
    //
  }

  public function extractColumnNames($excludeIdField = false)
  {
    $tableStructure = $this->db->query('DESCRIBE article')->fetchAll();

    $fieldValues = [];

    foreach ($tableStructure as $tableColumn) {
      $fieldName = $tableColumn["Field"];

      if (!$excludeIdField || $fieldName !== 'id') {
        $fieldValues[] = $fieldName;
      }
    }

    return $fieldValues;
  }

  public function getTotalArticleCount()
  {
    return $this->db->query("SELECT COUNT(*) FROM article")->fetchColumn();
  }

  public function getAllArticles($page = 1, $perPage = 10)
  {
    $offset = ($page - 1) * $perPage;
    $query = "SELECT a.id, a.designation, a.prix_ht, CONCAT(ROUND(a.tva * 100), '%') AS tva, a.stock, f.famille FROM article a JOIN famille f ON a.famille_id = f.id ORDER BY a.id LIMIT $perPage OFFSET $offset";
    return $this->db->query($query)->fetchAll();
  }

  public function getArticleById($id)
  {
    return $this->db->query('SELECT * FROM article WHERE id = :id', [
      'id' => $id
    ])->fetch();
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

  public function getModelRelationships(...$relatedModels)
  {
    if (count(self::FOREIGN_KEYS) !== count($relatedModels)) {
      throw new Exception("Need " . count(self::FOREIGN_KEYS) . " foreign keys per relationship");
    }

    $relationships = [];

    foreach ($relatedModels as $index => $item) {
      $key = array_values(self::FOREIGN_KEYS)[$index];
      $relationships[$key] = $item;
    }

    return $relationships;
  }
}
