<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Reglement.php');

$reglementModel = new Reglement();

checkRequestedMethodExists('put');

$requiredFields = $reglementModel->getTableFieldNames();

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $reglementModel->updateReglement(...$postValues);

    redirect('/reglements');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
