<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/DetailBL.php');

$detailBLModel = new DetailBL();

$detailBL = $_GET['bl-id'];

// $gg = $detailBLModel->getDetailsBL($detailBL);

$detailBLModel->getArticles();

view('index', [
  // 'records' => $bonsLivraisons['collection'],
  // 'paginate' => $bonsLivraisons['pagination'],
  // 'columns' => BonLivraison::COLUMNS,
  // 'section' => BonLivraison::SECTION,
  // 'caption' => BonLivraison::CAPTION
]);
