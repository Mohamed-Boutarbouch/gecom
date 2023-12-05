<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Client.php');

$clientModel = new Client();

$inputFields = $clientModel->getTableFieldNames(true);

view('create', [
  'inputFields' => $inputFields,
  'section' => Client::SECTION
]);
