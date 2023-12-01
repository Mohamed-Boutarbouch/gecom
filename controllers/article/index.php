<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

$section = 'article';
$caption = 'La liste des articles';

try {
  $results = $db->query("SELECT a.id, a.designation, a.prix_ht, CONCAT(a.tva * 100, '%') AS tva, a.stock, f.famille FROM article a JOIN famille f ON a.famille_id = f.id ORDER BY a.id")->fetchAll();

  view('index', [
    'results' => $results,
    'keys' => !empty($results) ? array_keys($results[0]) : [],
    'section' => $section,
    'caption' => $caption
  ]);
} catch (PDOException $e) {
  die('Database error: ' . $e->getMessage());
}
