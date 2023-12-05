<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Article.php');

$articleModel = new Article();

$requiredFields = $articleModel->getTableFieldNames(true);

try {
  $postValues = extractPostValues($requiredFields['fields']);
  if (validated(...$postValues)) {
    $articleModel->createArticle(...$postValues);

    redirect('/articles');
  } else {
    throwException('Assurez-vous que toutes les saisies sont remplies !');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
