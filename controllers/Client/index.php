<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/Client.php');

$clientModel = new Client();

$currentPageNumber = getCurrentPageNumber($_GET['page'] ?? '');

$clients = $clientModel->getClients($currentPageNumber);

view('index', [
  'records' => $clients['collection'],
  'paginate' => $clients['pagination'],
  'columns' => Client::COLUMNS,
  'section' => Client::SECTION,
  'caption' => Client::CAPTION
]);
