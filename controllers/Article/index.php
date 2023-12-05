<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Article.php');

$articleModel = new Article();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$articles = $articleModel->getArticles($currentPageNumber);

view('index', [
  'records' => $articles['collection'],
  'paginate' => $articles['pagination'],
  'columns' => Article::COLUMNS,
  'section' => Article::SECTION,
  'caption' => Article::CAPTION
]);
