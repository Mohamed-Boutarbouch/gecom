<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/BonLivraison.php');

$bonLivraisonModel = new BonLivraison();

checkRequestedMethodExists('put');

$requiredFields = $bonLivraisonModel->getTableFieldNames();

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $bonLivraisonModel->updateBonLivraison(...$postValues);

    redirect('/bons_livraisons');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
