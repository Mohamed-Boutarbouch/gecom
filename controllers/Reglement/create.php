<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Reglement.php');

$reglementModel = new Reglement();

$inputFields = $reglementModel->getFieldNamesWithRelationships();

view('create', [
  'inputFields' => $inputFields,
  'section' => Reglement::SECTION
]);
