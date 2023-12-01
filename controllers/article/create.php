<?php

const BASE_PATH = __DIR__ . '/../../';
const REDIRECT_URL = '/article';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'article';

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['designation']) && isset($_POST['prix_ht']) && isset($_POST['tva']) && isset($_POST['stock']) && isset($_POST['famille'])) {
      $db->query("INSERT INTO article(designation, prix_ht, tva, stock, famille) VALUES (:designation, :prix_ht, :tva, :stock, :famille)", [
        'designation' => $_POST['designation'],
        'prix_ht' => $_POST['prix_ht'],
        'tva' => $_POST['tva'],
        'stock' => $_POST['stock'],
        'famille' => $_POST['famille'],
      ]);

      header('location: ' . REDIRECT_URL);
      die();
    } else {
      header('location: ' . REDIRECT_URL);
      die();
    }
  }

  $columns = $db->query("DESCRIBE {$section}")->fetchAll();
  $filteredColumns = hideIdColumn($columns);

  view('create', [
    'section' => $section,
    'filteredColumns' => $filteredColumns
  ]);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
