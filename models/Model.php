<?php

abstract class Model
{
  protected $db;

  protected $displayDataCollection = ['collection' => [], 'pagination' => []];
  protected $editFormValues = ['data' => [], 'relationships' => []];
  protected $getFormInputNames = ['fields' => [], 'relationships' => []];

  public function __construct()
  {
    $config = require(BASE_PATH . 'config.php');
    $this->db = new Database($config['database']);
  }

  abstract protected function getTableName(): string;

  private function getTotalRecords()
  {
    $tableName = $this->getTableName();
    return $this->db->query("SELECT COUNT(*) FROM $tableName")->fetchColumn();
  }

  public function getTableFieldNames(bool $excludeIdField = false)
  {
    $tableName = $this->getTableName();
    $tableStructure = $this->db->query("DESCRIBE $tableName")->fetchAll();

    foreach ($tableStructure as $tableColumn) {
      $fieldName = $tableColumn["Field"];
      if (!$excludeIdField || $fieldName !== 'id') {
        $this->getFormInputNames['fields'][] = $fieldName;
      }
    }

    return $this->getFormInputNames;
  }

  protected function paginate($currentPageNumber, $totalRecordsPerPage)
  {
    $previousPage = $currentPageNumber - 1;
    $nextPage = $currentPageNumber + 1;
    $adjacent = '2';

    $totalRecords = $this->getTotalRecords();

    if ($totalRecordsPerPage + 1 > $totalRecords) {
      return;
    }

    $totalPages = ceil($totalRecords / $totalRecordsPerPage);
    $secondLast = $totalPages - 1;

    return $this->displayDataCollection['pagination'] = [
      'currentPageNumber' => $currentPageNumber,
      'totalPages' => $totalPages,
      'previousPage' => $previousPage,
      'nextPage' => $nextPage,
      'adjacent' => $adjacent,
      'secondLast' => $secondLast,
    ];
  }
}
