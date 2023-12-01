<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Famille.php');
$familleModel = new Famille($db);

$records = $familleModel->getAllFamilles();

$columns = $familleModel->extractColumnNames();

view('index', [
  'records' => $records,
  'columns' => $columns,
  'section' => Famille::SECTION,
  'caption' => Famille::CAPTION
]);
