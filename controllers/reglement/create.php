<?php

const BASE_PATH = __DIR__ . '/../../';
const REDIRECT_URL = '/reglement';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'reglement';

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mode']) && isset($_POST['regle']) && isset($_POST['montant']) && isset($_POST['date'])) {
      $db->query("INSERT INTO reglement(mode, regle, montant, date) VALUES (:mode, :regle, :montant, :date)", [
        'mode' => $_POST['mode'],
        'regle' => $_POST['regle'],
        'montant' => $_POST['montant'],
        'date' => $_POST['date']
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
