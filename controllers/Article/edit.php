<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Article.php');
require(BASE_PATH . 'models/Famille.php');
$articleModel = new Article($db);
$familleModel = new Famille($db);

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $articleModel->getArticleById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

$relationships = $articleModel->getModelRelationships($familleModel->getFamilleSelectOptions());

view('edit', [
  'record' => $record,
  'relationships' => $relationships,
  'foreignKeys' => Article::FOREIGN_KEYS,
  'section' => Article::SECTION
]);
