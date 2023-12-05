<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Client.php');

$clientModel = new Client();

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
