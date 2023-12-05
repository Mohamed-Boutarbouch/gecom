<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Caissier.php');

$caissierModel = new Caissier();

checkRequestedMethodExists('put');

$requiredFields = $caissierModel->getTableFieldNames();

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $caissierModel->updateCaissier(...$postValues);

    redirect('/caissiers');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
