<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Client.php');
$clientModel = new Client($db);

$requiredFields = $clientModel->extractColumnNames(true);

try {
  $postValues = extractPostValues($requiredFields);

  if (validated(...$postValues)) {
    $clientModel->createClient(...$postValues);

    redirect('/clients');
  } else {
    throwException('Assurez-vous que toutes les saisies sont remplies !');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
