<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$section = 'mode_reglement';
$caption = 'La liste des mode_reglements';

try {
  $db = new Database($config['database']);

  $results = $db->query('SELECT * FROM mode_reglement')->fetchAll();
  view('index', [
    'results' => $results,
    'keys' => !empty($results) ? array_keys($results[0]) : [],
    'section' => $section,
    'caption' => $caption
  ]);
} catch (PDOException $e) {
  die('Database error: ' . $e->getMessage());
}
