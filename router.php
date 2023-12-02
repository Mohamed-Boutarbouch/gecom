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
  '/articles/creer' => 'controllers/article/create.php',
  '/articles/enregistrer' => 'controllers/article/store.php',
  '/articles/editer' => 'controllers/article/edit.php',
  '/articles/modifier' => 'controllers/article/update.php',
  '/articles/supprimer' => 'controllers/article/destroy.php',

  /* Bon Livraison routes */
  '/bons_livraisons' => 'controllers/article/index.php',

  /* Reglement routes */
  '/reglements' => 'controllers/reglement/index.php',
  // '/reglements/creer' => 'controllers/reglement/create.php',
  // '/reglements/enregistrer' => 'controllers/reglement/store.php',
  // '/reglements/editer' => 'controllers/reglement/edit.php',
  // '/reglements/modifier' => 'controllers/reglement/update.php',
  // '/reglements/supprimer' => 'controllers/reglement/destroy.php'
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
