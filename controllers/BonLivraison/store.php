<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/BonLivraison.php');

$bonLivraisonModel = new BonLivraison();

$requiredFields = $bonLivraisonModel->getTableFieldNames(true);

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $bonLivraisonModel->createBonLivraison(...$postValues);

    redirect('/bons_livraisons');
  } else {
    throwException('Assurez-vous que toutes les saisies sont remplies !');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
