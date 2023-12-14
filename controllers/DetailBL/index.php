<?php

const BASE_PATH = __DIR__ . '/../../';

require(BASE_PATH . 'Database.php');
require(BASE_PATH . 'models/DetailBL.php');

$detailBLModel = new DetailBL();

$blId = $_GET['bl-id'] ?? '1';
$inputFields = $detailBLModel->getFieldNamesWithRelationships();
$finalTotal = $detailBLModel->finalTotal($blId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_submitted'])) {
  if (isset($_POST['article_id']) && isset($_POST['bl_id']) && isset($_POST['qte']) && !empty($_POST['qte'])) {
    $detailBLModel->storeDetailBL($_POST['article_id'], $_POST['bl_id'], $_POST['qte']);
    echo "<meta http-equiv='refresh' content='0'>";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
  $detailBLModel->deleteDetailBL($_POST['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['increase'])) {
    $detailBLModel->increaseQuantity($_POST['increase']);
  }
  if (isset($_POST['decrease'])) {
    $detailBLModel->decreaseQuantity($_POST['decrease']);
  }
  echo "<meta http-equiv='refresh' content='0'>";
}

view('detailBl', [
  'records' => $detailBLModel->getDetailBL($blId),
  'inputFields' => $inputFields,
  'blId' => $blId,
  'finalTotal' => $finalTotal,
  'columns' => DetailBL::COLUMNS,
  'section' => DetailBL::SECTION,
  'caption' => DetailBL::CAPTION
]);
