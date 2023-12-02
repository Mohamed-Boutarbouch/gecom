<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Famille.php');
$familleModel = new Famille($db);

checkRequestedMethodExists('put');

$requiredFields = $familleModel->extractColumnNames();

try {
  $postValues = extractPostValues($requiredFields);

  if (validated(...$postValues)) {
    $familleModel->updateFamille(...$postValues);

    redirect('/');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
