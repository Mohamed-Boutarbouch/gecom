<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Client.php');

$clientModel = new Client();

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $clientModel->getClientById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => Client::SECTION
]);
