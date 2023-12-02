<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'mode_reglement';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT') {
  if (!isset($_POST['id']) && !isset($_POST['mode'])) {
    throw new Exception('Requête invalide. Paramètres requis manquants.');
  }

  $updateResult = $db->query('UPDATE mode_reglement SET mode = :mode WHERE id = :id', [
    'mode' => $_POST['mode'],
    'id' => $_POST['id']
  ]);

  if ($updateResult === false) {
    throw new Exception('Erreur lors de la mise à jour de l\'enregistrement.');
  }

  header('location: /mode_reglement');
  die();
}

if (!isset($_GET['id'])) {
  throw new Exception('Requête invalide. ID manquante.');
}

$row = $db->query('SELECT * FROM mode_reglement WHERE id = :id', [
  'id' => $_GET['id']
])->fetch();

if (!$row) {
  throw new Exception('Enregistrement non trouvé.');
}

view('edit', [
  'section' => $section,
  'row' => $row
]);
