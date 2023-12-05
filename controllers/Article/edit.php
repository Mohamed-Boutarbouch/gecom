<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Article.php');

$articleModel = new Article();

if (!validated($_GET['id'])) {
  throwException('Requête invalide. ID manquante.');
}

$record = $articleModel->getArticleById($_GET['id']);

if (!$record) {
  throwException('Enregistrement non trouvé.');
}

view('edit', [
  'record' => $record,
  'section' => Article::SECTION
]);
