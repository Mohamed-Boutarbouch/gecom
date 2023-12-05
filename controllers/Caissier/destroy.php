<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Caissier.php');

$caissierModel = new Caissier();

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $caissierModel->deleteCaissier($_POST['id']);

    redirect('/caissiers');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
