<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Article.php');

$articleModel = new Article();

checkRequestedMethodExists('put');

$requiredFields = $articleModel->getTableFieldNames();

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $articleModel->updateArticle(...$postValues);

    redirect('/articles');
  } else {
    throwException('Requête invalide. Paramètres requis manquants.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
