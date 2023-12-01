<?php
$startPage = max(1, $currentPage - floor($perPage / 2));
$endPage = min($totalPages, $startPage + $perPage - 1);

function isFamilleSection($section)
{
  return $section !== 'familles' ? $section : '';
}
?>

<div class="pagination">
  <?php if ($currentPage > $perPage) : ?>
    <a href='/<?= isFamilleSection($section) ?>?page=1'>1</a>
  <?php endif; ?>

  <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
    <a href="/<?= isFamilleSection($section) ?>?page=<?= $i ?>" <?= $currentPage == $i ? 'class="active"' : '' ?>><?= $i ?></a>
  <?php endfor; ?>

  <?php if ($currentPage < $totalPages - $perPage) : ?>
    <a href='/<?= isFamilleSection($section) ?>?page=<?= $totalPages ?>'><?= $totalPages ?></a>
  <?php endif; ?>
</div>