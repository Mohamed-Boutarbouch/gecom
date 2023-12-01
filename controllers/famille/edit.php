<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Famille.php');
$familleModel = new Famille($db);

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $familleModel->getFamilleById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => Famille::SECTION
]);
