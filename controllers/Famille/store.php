<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Famille.php');
$familleModel = new Famille($db);

$requiredFields = $familleModel->extractColumnNames(true);

try {
  $postValues = extractPostValues($requiredFields);

  if (validated(...$postValues)) {
    $familleModel->createFamille(...$postValues);

    redirect('/');
  } else {
    throwException('Assurez-vous que toutes les saisies sont remplies !');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
