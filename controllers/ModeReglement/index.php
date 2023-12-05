<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/ModeReglement.php');

$modeReglementModel = new ModeReglement();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$modesReglement = $modeReglementModel->getModesReglement($currentPageNumber);

view('index', [
  'records' => $modesReglement['collection'],
  'paginate' => $modesReglement['pagination'],
  'columns' => ModeReglement::COLUMNS,
  'section' => ModeReglement::SECTION,
  'caption' => ModeReglement::CAPTION
]);
