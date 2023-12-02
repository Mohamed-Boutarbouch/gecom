<?php

const BASE_PATH = __DIR__ . '/../../';
const PER_PAGE = 10;

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Reglement.php');
$reglementModel = new Reglement($db);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records = $reglementModel->getAllReglements($page);
$totalRecords = $reglementModel->getTotalReglementCount();
$totalPages = ceil($totalRecords / PER_PAGE);

$columns = ['id', 'mode', 'regle', 'montant', 'date reglement', 'date bon livraison'];

view('index', [
  'records' => $records,
  'columns' => $columns,
  'currentPage' => $page,
  'perPage' => PER_PAGE,
  'totalPages' => $totalPages,
  'totalRecords' => $totalRecords,
  'section' => Reglement::SECTION,
  'caption' => Reglement::CAPTION
]);
