<?php

const BASE_PATH = __DIR__ . '/../../';
const PER_PAGE = 10;

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Article.php');
$articleModel = new Article($db);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records = $articleModel->getAllArticles($page);
$totalRecords = $articleModel->getTotalArticleCount();
$totalPages = ceil($totalRecords / PER_PAGE);

$columns = ['id', 'designation', 'prix hors taxe', 'TVA', 'stock', 'famille'];

view('index', [
  'records' => $records,
  'columns' => $columns,
  'currentPage' => $page,
  'perPage' => PER_PAGE,
  'totalPages' => $totalPages,
  'totalRecords' => $totalRecords,
  'section' => Article::SECTION,
  'caption' => Article::CAPTION
]);
