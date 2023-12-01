<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Client.php');
$clientModel = new Client($db);

$records = $clientModel->getAllClients();

$columns = ['id', 'nom complet', 'adresse', 'ville'];

view('index', [
  'records' => $records,
  'columns' => $columns,
  'section' => Client::SECTION,
  'caption' => Client::CAPTION
]);
