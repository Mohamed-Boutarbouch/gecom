<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/DetailBL.php');

$detailBLModel = new DetailBL();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $requestData = json_decode(file_get_contents('php://input'), true);

  if (isset($requestData['productName'])) {
    $productName = $requestData['productName'];
    $searchResults = $detailBLModel->searchProduct($productName);

    header('Content-Type: application/json');
    echo json_encode($searchResults);
    exit;
  } else {
    http_response_code(400);
    echo json_encode(['error' => 'Product name is missing']);
    exit;
  }
}

// view('detailBl', [
//   'records' => $detailBLModel->getArticles(),
//   'columns' => DetailBL::COLUMNS,
//   'section' => DetailBL::SECTION,
//   'caption' => DetailBL::CAPTION
// ]);
