<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Caissier.php');

$caissierModel = new Caissier();

$requiredFields = $caissierModel->getTableFieldNames(true);

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $caissierModel->createCaissier(...$postValues);

    redirect('/caissiers');
  } else {
    throwException('Assurez-vous que toutes les saisies sont remplies !');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
