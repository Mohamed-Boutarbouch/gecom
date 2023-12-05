<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/ModeReglement.php');

$modeReglementModel = new ModeReglement();

checkRequestedMethodExists('put');

$requiredFields = $modeReglementModel->getTableFieldNames();

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $modeReglementModel->updateModeReglement(...$postValues);

    redirect('/modes_reglement');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
