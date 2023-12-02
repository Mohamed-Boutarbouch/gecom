<?php
const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Article.php');
require(BASE_PATH . 'models/Famille.php');
$articleModel = new Article($db);
$familleModel = new Famille($db);

$columns = $articleModel->extractColumnNames(true);

$relationships = $articleModel->getModelRelationships($familleModel->getFamilleSelectOptions());

view('create', [
  'columns' => $columns,
  'relationships' => $relationships,
  'foreignKeys' => Article::FOREIGN_KEYS,
  'section' => Article::SECTION
]);
