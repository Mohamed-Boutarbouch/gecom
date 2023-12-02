<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'DELETE') {
  if (!isset($_POST['id'])) {
    die('Requête invalide. ID manquante.');
  }

  $existingRecord = $db->query('SELECT * FROM article WHERE id = :id', [
    'id' => $_POST['id']
  ])->fetch();

  if (!$existingRecord) {
    die('Enregistrement non trouvé.');
  }

  $deleteResult = $db->query('DELETE FROM article WHERE id = :id', [
    'id' => $_POST['id']
  ]);

  if ($deleteResult === false) {
    die('Erreur lors de la suppression de l\'enregistrement.');
  }

  header('location: /article');
  die();
}
