<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/ModeReglement.php');

$modeReglementModel = new ModeReglement();

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $modeReglementModel->deleteModeReglement($_POST['id']);

    redirect('/modes_reglement');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
