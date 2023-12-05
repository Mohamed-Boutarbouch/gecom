<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Famille.php');

$familleModel = new Famille();

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $familleModel->deleteFamille($_POST['id']);

    redirect('/');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
