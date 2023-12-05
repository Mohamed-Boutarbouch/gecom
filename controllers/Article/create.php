<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Article.php');

$articleModel = new Article();

$inputFields = $articleModel->getFieldNamesWithRelationships();

view('create', [
  'inputFields' => $inputFields,
  'section' => Article::SECTION
]);
