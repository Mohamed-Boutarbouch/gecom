<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Client.php');
$clientModel = new Client($db);

$columns = $clientModel->extractColumnNames(true);

view('create', [
  'columns' => $columns,
  'section' => Client::SECTION
]);
