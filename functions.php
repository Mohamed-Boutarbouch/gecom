<?php

function dd(...$values)
{
  foreach ($values as $value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    echo "<hr />";
  }

  die();
}

function urlIs($value)
{
  // dd($value, $_SERVER['REQUEST_URI']);
  return parse_url($_SERVER['REQUEST_URI'])['path'] === $value;
}

// urlIs('/caissier');

function view($path, $attributes = [])
{
  extract($attributes);

  require BASE_PATH . 'views/' . $path . '.view.php';
}

function isFamilleSection($section)
{
  return $section !== 'familles' ? $section : '';
}

function validated(...$inputs)
{
  $booleans = [];
  foreach ($inputs as $input) {
    $booleans[] = isset($input) && trim($input) !== '';
  }
  return !in_array(false, $booleans, true);
}

function extractPostValues(array $requiredFields): array
{
  return array_map(function ($field) {
    return $_POST[$field];
  }, $requiredFields);
}

function redirect($url)
{
  header('location: ' . $url);
  die();
}

function throwException($message, $redirectUrl = null)
{
  if ($redirectUrl === null) {
    $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/';
  }

  echo "<a href='{$redirectUrl}'>Retourne</a><br />";
  throw new ErrorException($message);
}

function checkRequestedMethodExists($method)
{
  if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['_method']) || $_POST['_method'] !== strtoupper($method)) {
    http_response_code(400);
    throw new Exception("Méthode de requête invalide ou paramètre _method manquant.", 400);
  }

  return true;
}

function isBooleanValueField($column)
{
  return in_array($column, ['admin', 'regle']);
}

function getCurrentPageNumber($pageNumber)
{
  if (isset($pageNumber) && $pageNumber !== '') {
    return $pageNumber;
  } else {
    return 1;
  }
}
