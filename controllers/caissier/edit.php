<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'caissier';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT') {
  if (!isset($_POST['id']) && !isset($_POST['nom']) && !isset($_POST['prenom']) && !isset($_POST['poste']) && !isset($_POST['admin'])) {
    throw new Exception('Requête invalide. Paramètres requis manquants.');
  }

  $updateResult = $db->query('UPDATE caissier SET nom = :nom, prenom = :prenom, poste = :poste, admin = :admin WHERE id = :id', [
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'poste' => $_POST['poste'],
    'admin' => $_POST['admin'],
    'id' => $_POST['id']
  ]);

  if ($updateResult === false) {
    throw new Exception('Erreur lors de la mise à jour de l\'enregistrement.');
  }

  header('location: /caissier');
  die();
}

if (!isset($_GET['id'])) {
  throw new Exception('Requête invalide. ID manquante.');
}

$row = $db->query('SELECT * FROM caissier WHERE id = :id', [
  'id' => $_GET['id']
])->fetch();

if (!$row) {
  throw new Exception('Enregistrement non trouvé.');
}

view('edit', [
  'section' => $section,
  'row' => $row
]);
