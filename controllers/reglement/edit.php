<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'article';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT') {
  if (!isset($_POST['id']) && !isset($_POST['designation']) && !isset($_POST['prix_ht']) && !isset($_POST['tva']) && !isset($_POST['stock']) && !isset($_POST['famille'])) {
    throw new Exception('Requête invalide. Paramètres requis manquants.');
  }

  $updateResult = $db->query('UPDATE article a JOIN famille f ON a.famille_id = f.id SET a.designation = :designation, a.prix_ht = :prix_ht, a.tva = :tva, a.stock = :stock, f.famille = :famille WHERE a.id = :id', [
    'designation' => $_POST['designation'],
    'prix_ht' => $_POST['prix_ht'],
    'tva' => $_POST['tva'],
    'stock' => $_POST['stock'],
    'famille' => $_POST['famille'],
    'id' => $_POST['id']
  ]);

  if ($updateResult === false) {
    throw new Exception('Erreur lors de la mise à jour de l\'enregistrement.');
  }

  header('location: /article');
  die();
}

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
