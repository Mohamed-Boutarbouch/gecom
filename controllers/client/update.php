<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Client.php');
$clientModel = new Client($db);

checkRequestedMethodExists('put');

$requiredFields = $clientModel->extractColumnNames();

try {
  $postValues = extractPostValues($requiredFields);

  if (validated(...$postValues)) {
    $clientModel->updateClient(...$postValues);

    redirect('/clients');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
