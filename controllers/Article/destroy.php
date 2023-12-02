<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

require(BASE_PATH . 'models/Article.php');
$articleModel = new Article($db);

checkRequestedMethodExists('delete');

try {
  if (validated($_POST['id'])) {
    $articleModel->deleteArticle($_POST['id']);

    redirect('/articles');
  } else {
    throwException('Erreur lors de la suppression de l\'enregistrement.');
  }
} catch (ErrorException $e) {
  echo 'Caught exception: ' . $e->getMessage();
}
