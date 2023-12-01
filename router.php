<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
  /* Famille routes */
  '/' => 'controllers/famille/index.php',
  '/familles/creer' => 'controllers/famille/create.php',
  '/familles/enregistrer' => 'controllers/famille/store.php',
  '/familles/editer' => 'controllers/famille/edit.php',
  '/familles/modifier' => 'controllers/famille/update.php',
  '/familles/supprimer' => 'controllers/famille/destroy.php',

  /* Client routes */
  '/clients' => 'controllers/client/index.php',
  '/clients/creer' => 'controllers/client/create.php',
  '/clients/enregistrer' => 'controllers/client/store.php',
  '/clients/editer' => 'controllers/client/edit.php',
  '/clients/modifier' => 'controllers/client/update.php',
  '/clients/supprimer' => 'controllers/client/destroy.php',

  /* Caissier routes */
  '/caissiers' => 'controllers/caissier/index.php',

  /* Mode reglement routes */
  '/modes_reglement' => 'controllers/mode_reglement/index.php',

  /* Article routes */
  '/articles' => 'controllers/article/index.php',

  /* Bon Livraison routes */
  '/bons_livraisons' => 'controllers/article/index.php',

  /* Reglement routes */
  '/reglements' => 'controllers/reglement/index.php'
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
