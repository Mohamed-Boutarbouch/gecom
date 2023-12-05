<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/ModeReglement.php');

$modeReglementModel = new ModeReglement();

$inputFields = $modeReglementModel->getTableFieldNames(true);

view('create', [
  'inputFields' => $inputFields,
  'section' => ModeReglement::SECTION
]);
