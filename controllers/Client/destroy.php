<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Client.php');
$clientModel = new Client($db);

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $clientModel->deleteClient($_POST['id']);

    redirect('/clients');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
