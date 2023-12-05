<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Reglement.php');

$reglementModel = new Reglement();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$reglements = $reglementModel->getReglements($currentPageNumber);

view('index', [
  'records' => $reglements['collection'],
  'paginate' => $reglements['pagination'],
  'columns' => Reglement::COLUMNS,
  'section' => Reglement::SECTION,
  'caption' => Reglement::CAPTION
]);
