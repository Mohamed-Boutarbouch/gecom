<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/BonLivraison.php');

$bonLivraisonModel = new BonLivraison();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$bonsLivraisons = $bonLivraisonModel->getBonsLivraisons($currentPageNumber);

view('index', [
  'records' => $bonsLivraisons['collection'],
  'paginate' => $bonsLivraisons['pagination'],
  'columns' => BonLivraison::COLUMNS,
  'section' => BonLivraison::SECTION,
  'caption' => BonLivraison::CAPTION
]);
