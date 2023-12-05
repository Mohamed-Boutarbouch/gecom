<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Reglement.php');

$reglementModel = new Reglement();

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $reglementModel->deleteReglement($_POST['id']);

    redirect('/reglements');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
