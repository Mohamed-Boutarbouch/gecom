<?php

const BASE_PATH = __DIR__ . '/../../';
const PER_PAGE = 10;

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Famille.php');
$familleModel = new Famille($db);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records = $familleModel->getAllFamilles($page);
$totalRecords = $familleModel->getTotalFamilleCount();
$totalPages = ceil($totalRecords / PER_PAGE);

$columns = $familleModel->extractColumnNames();

view('index', [
  'records' => $records,
  'columns' => $columns,
  'currentPage' => $page,
  'perPage' => PER_PAGE,
  'totalPages' => $totalPages,
  'totalRecords' => $totalRecords,
  'section' => Famille::SECTION,
  'caption' => Famille::CAPTION
]);
