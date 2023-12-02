<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'article';

if (!isset($_GET['id'])) {
  throw new Exception('Requête invalide. ID manquante.');
}

$row = $db->query("SELECT a.id, a.designation, a.prix_ht, a.tva, a.stock, f.famille FROM article a JOIN famille f ON a.famille_id = f.id WHERE a.id = :id", [
  'id' => $_GET['id']
])->fetch();

if (!$row) {
  throw new Exception('Enregistrement non trouvé.');
}

view('edit', [
  'section' => $section,
  'row' => $row
]);
