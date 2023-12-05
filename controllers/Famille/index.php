<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Famille.php');

$familleModel = new Famille();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$familles = $familleModel->getFamilles($currentPageNumber);

view('index', [
  'records' => $familles['collection'],
  'paginate' => $familles['pagination'],
  'columns' => Famille::COLUMNS,
  'section' => Famille::SECTION,
  'caption' => Famille::CAPTION
]);
