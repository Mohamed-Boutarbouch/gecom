<?php

const BASE_PATH = __DIR__ . '/../../';
const REDIRECT_URL = '/mode_reglement';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'mode_reglement';

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mode'])) {
      $db->query("INSERT INTO mode_reglement(mode) VALUES (:mode)", [
        'mode' => $_POST['mode']
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
