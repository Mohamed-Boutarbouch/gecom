<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/BonLivraison.php');

$bonLivraisonModel = new BonLivraison();

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $bonLivraisonModel->getBonLivraisonById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => BonLivraison::SECTION
]);
