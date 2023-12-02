<?php

const BASE_PATH = __DIR__ . '/../../';
const REDIRECT_URL = '/reglement';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$db = new Database($config['database']);

$section = 'reglement';

$columns = $db->query("DESCRIBE {$section}")->fetchAll();
// $filteredColumns = hideIdColumn($columns);

view('create', [
  'section' => $section,
  'filteredColumns' => $filteredColumns
]);
