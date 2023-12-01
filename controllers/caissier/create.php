<?php

const BASE_PATH = __DIR__ . '/../../';
const REDIRECT_URL = '/caissier';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'caissier';

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['poste']) && isset($_POST['admin'])) {
      $db->query("INSERT INTO caissier(nom, prenom, poste, admin) VALUES (:nom, :prenom, :poste, :admin)", [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'poste' => $_POST['poste'],
        'admin' => $_POST['admin'],
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
