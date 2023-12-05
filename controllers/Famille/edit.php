<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Famille.php');

$familleModel = new Famille();

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
