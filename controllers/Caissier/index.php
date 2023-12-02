<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');

$section = 'caissier';
$caption = 'La liste des caissiers';

try {
  $db = new Database($config['database']);

  $results = $db->query("SELECT id, nom, prenom, poste, CASE admin WHEN 1 THEN 'Oui' WHEN 0 THEN 'Non' END AS admin FROM caissier")->fetchAll();

  view('index', [
    'results' => $results,
    'keys' => !empty($results) ? array_keys($results[0]) : [],
    'section' => $section,
    'caption' => $caption
  ]);
} catch (PDOException $e) {
  die('Database error: ' . $e->getMessage());
}
