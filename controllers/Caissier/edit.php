<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Caissier.php');

$caissierModel = new Caissier();

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $caissierModel->getCaissierById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => Caissier::SECTION
]);
