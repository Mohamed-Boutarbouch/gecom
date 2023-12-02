<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Famille.php');
$familleModel = new Famille($db);

$columns = $familleModel->extractColumnNames(true);

view('create', [
  'columns' => $columns,
  'section' => Famille::SECTION
]);
