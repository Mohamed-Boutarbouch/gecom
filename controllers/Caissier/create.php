<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Caissier.php');

$caissierModel = new Caissier();

$inputFields = $caissierModel->getTableFieldNames(true);

view('create', [
  'inputFields' => $inputFields,
  'section' => Caissier::SECTION
]);
