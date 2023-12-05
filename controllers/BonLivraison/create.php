<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/BonLivraison.php');

$bonLivraisonModel = new BonLivraison();

$inputFields = $bonLivraisonModel->getFieldNamesWithRelationships();

view('create', [
  'inputFields' => $inputFields,
  'section' => BonLivraison::SECTION
]);
