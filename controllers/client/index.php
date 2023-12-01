<?php

const BASE_PATH = __DIR__ . '/../../';
const PER_PAGE = 10;

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Client.php');
$clientModel = new Client($db);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records = $clientModel->getAllClients($page);
$totalRecords = $clientModel->getTotalClientCount();
$totalPages = ceil($totalRecords / PER_PAGE);

$columns = ['id', 'nom complet', 'adresse', 'ville'];

view('index', [
  'records' => $records,
  'columns' => $columns,
  'currentPage' => $page,
  'perPage' => PER_PAGE,
  'totalPages' => $totalPages,
  'totalRecords' => $totalRecords,
  'section' => Client::SECTION,
  'caption' => Client::CAPTION
]);
