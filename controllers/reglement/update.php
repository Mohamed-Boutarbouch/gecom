<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT') {
  if (!isset($_POST['id']) && !isset($_POST['designation']) && !isset($_POST['prix_ht']) && !isset($_POST['tva']) && !isset($_POST['stock']) && !isset($_POST['famille'])) {
    throw new Exception('Requête invalide. Paramètres requis manquants.');
  }

  $updateResult = $db->query('UPDATE article a JOIN famille f ON a.famille_id = f.id SET a.designation = :designation, a.prix_ht = :prix_ht, a.tva = :tva, a.stock = :stock, f.famille = :famille WHERE a.id = :id', [
    'designation' => $_POST['designation'],
    'prix_ht' => $_POST['prix_ht'],
    'tva' => $_POST['tva'],
    'stock' => $_POST['stock'],
    'famille' => $_POST['famille'],
    'id' => $_POST['id']
  ]);

  if ($updateResult === false) {
    throw new Exception('Erreur lors de la mise à jour de l\'enregistrement.');
  }

  header('location: /article');
  die();
}
