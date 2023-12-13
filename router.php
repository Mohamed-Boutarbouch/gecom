<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
  /* Famille routes */
  '/' => 'controllers/Famille/index.php',
  '/familles/creer' => 'controllers/Famille/create.php',
  '/familles/enregistrer' => 'controllers/Famille/store.php',
  '/familles/editer' => 'controllers/Famille/edit.php',
  '/familles/modifier' => 'controllers/Famille/update.php',
  '/familles/supprimer' => 'controllers/Famille/destroy.php',

  /* Client routes */
  '/clients' => 'controllers/Client/index.php',
  '/clients/creer' => 'controllers/Client/create.php',
  '/clients/enregistrer' => 'controllers/Client/store.php',
  '/clients/editer' => 'controllers/Client/edit.php',
  '/clients/modifier' => 'controllers/Client/update.php',
  '/clients/supprimer' => 'controllers/Client/destroy.php',

  /* Caissier routes */
  '/caissiers' => 'controllers/Caissier/index.php',
  '/caissiers/creer' => 'controllers/Caissier/create.php',
  '/caissiers/enregistrer' => 'controllers/Caissier/store.php',
  '/caissiers/editer' => 'controllers/Caissier/edit.php',
  '/caissiers/modifier' => 'controllers/Caissier/update.php',
  '/caissiers/supprimer' => 'controllers/Caissier/destroy.php',

  /* Mode reglement routes */
  '/modes_reglement' => 'controllers/ModeReglement/index.php',
  '/modes_reglement/creer' => 'controllers/ModeReglement/create.php',
  '/modes_reglement/enregistrer' => 'controllers/ModeReglement/store.php',
  '/modes_reglement/editer' => 'controllers/ModeReglement/edit.php',
  '/modes_reglement/modifier' => 'controllers/ModeReglement/update.php',
  '/modes_reglement/supprimer' => 'controllers/ModeReglement/destroy.php',

  /* Article routes */
  '/articles' => 'controllers/Article/index.php',
  '/articles/creer' => 'controllers/Article/create.php',
  '/articles/enregistrer' => 'controllers/Article/store.php',
  '/articles/editer' => 'controllers/Article/edit.php',
  '/articles/modifier' => 'controllers/Article/update.php',
  '/articles/supprimer' => 'controllers/Article/destroy.php',

  /* Bon Livraison routes */
  '/bons_livraisons' => 'controllers/BonLivraison/index.php',
  '/bons_livraisons/creer' => 'controllers/BonLivraison/create.php',
  '/bons_livraisons/enregistrer' => 'controllers/BonLivraison/store.php',
  '/bons_livraisons/editer' => 'controllers/BonLivraison/edit.php',
  '/bons_livraisons/modifier' => 'controllers/BonLivraison/update.php',
  '/bons_livraisons/supprimer' => 'controllers/BonLivraison/destroy.php',

  /* Reglement routes */
  '/reglements' => 'controllers/Reglement/index.php',
  '/reglements/creer' => 'controllers/Reglement/create.php',
  '/reglements/enregistrer' => 'controllers/Reglement/store.php',
  '/reglements/editer' => 'controllers/Reglement/edit.php',
  '/reglements/modifier' => 'controllers/Reglement/update.php',
  '/reglements/supprimer' => 'controllers/Reglement/destroy.php',

  /* Reglement routes */
  '/detail-bl' => 'controllers/DetailBL/index.php',
  '/detail-bl/search' => 'controllers/DetailBL/show.php'
];

function routeToController($uri, $routes)
{
  if (array_key_exists($uri, $routes)) {
    require($routes[$uri]);
  } else {
    echo "<h1>Page not Found. <a href='/'>Go Back Home</a><h1>";

    die();
  }
}

routeToController($uri, $routes);
