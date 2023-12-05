<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/ModeReglement.php');

$modeReglementModel = new ModeReglement();

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $modeReglementModel->getModeReglementById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => ModeReglement::SECTION
]);
