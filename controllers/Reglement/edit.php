<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Reglement.php');

$reglementModel = new Reglement();

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $reglementModel->getReglementById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => Reglement::SECTION
]);
