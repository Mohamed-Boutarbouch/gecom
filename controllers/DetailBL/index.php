<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/DetailBL.php');

$detailBLModel = new DetailBL();

$blId = $_GET['bl-id'] ?? '1';
// $detailBLModel->getTotalPrice($blId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['increase'])) {
    $detailBLModel->increaseQuantity($_POST['increase']);
  }
  if (isset($_POST['decrease'])) {
    $detailBLModel->decreaseQuantity($_POST['decrease']);
  }
}

view('detailBl', [
  'records' => $detailBLModel->getDetailBL($blId),
  'columns' => DetailBL::COLUMNS,
  'section' => DetailBL::SECTION,
  'caption' => DetailBL::CAPTION
]);
