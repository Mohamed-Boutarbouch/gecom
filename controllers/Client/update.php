<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Client.php');

$clientModel = new Client();

checkRequestedMethodExists('put');

$requiredFields = $clientModel->getTableFieldNames();

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $clientModel->updateClient(...$postValues);

    redirect('/clients');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
