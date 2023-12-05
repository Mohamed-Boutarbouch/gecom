<table>
  <caption><?= $caption ?></caption>
  <thead>
    <?php require 'thead.php' ?>
  </thead>
  <tbody>
    <?php require 'tbody.php' ?>
  </tbody>
</table>
<?php // if ($totalRecords > 10) {
require 'tfoot.php';
// } 
?>