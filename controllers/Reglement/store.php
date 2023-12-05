<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Reglement.php');

$reglementModel = new Reglement();

$requiredFields = $reglementModel->getTableFieldNames(true);

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $reglementModel->createReglement(...$postValues);

    redirect('/reglements');
  } else {
    throwException('Assurez-vous que toutes les saisies sont remplies !');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
