<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Caissier.php');

$caissierModel = new Caissier();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$caissiers = $caissierModel->getCaissiers($currentPageNumber);

view('index', [
  'records' => $caissiers['collection'],
  'paginate' => $caissiers['pagination'],
  'columns' => Caissier::COLUMNS,
  'section' => Caissier::SECTION,
  'caption' => Caissier::CAPTION
]);
