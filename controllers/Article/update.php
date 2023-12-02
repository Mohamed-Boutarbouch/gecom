<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Article.php');
$articleModel = new Article($db);

checkRequestedMethodExists('put');

$requiredFields = $articleModel->extractColumnNames();

try {
  $postValues = extractPostValues($requiredFields);
  if (validated(...$postValues)) {
    $articleModel->updateArticle(...$postValues);

    redirect('/articles');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
