<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/BonLivraison.php');

$bonLivraisonModel = new BonLivraison();

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $bonLivraisonModel->deleteBonLivraison($_POST['id']);

    redirect('/bons_livraisons');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
