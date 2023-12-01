<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
$config = require(BASE_PATH . 'config.php');
$db = new Database($config['database']);

$section = 'reglement';
$caption = 'La liste des reglements';

try {
  $results = $db->query("SELECT r.id, mr.mode, bl.regle, r.montant, r.date FROM reglement r JOIN BonLivraison bl ON r.bl_id = bl.id JOIN mode_reglement mr ON r.mode_id = mr.id ORDER BY r.id")->fetchAll();

  view('index', [
    'results' => $results,
    'keys' => !empty($results) ? array_keys($results[0]) : [],
    'section' => $section,
    'caption' => $caption
  ]);
} catch (PDOException $e) {
  die('Database error: ' . $e->getMessage());
}
