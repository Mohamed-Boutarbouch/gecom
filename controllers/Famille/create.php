<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Famille.php');

$familleModel = new Famille();

$inputFields = $familleModel->getTableFieldNames(true);

view('create', [
  'inputFields' => $inputFields,
  'section' => Famille::SECTION
]);
