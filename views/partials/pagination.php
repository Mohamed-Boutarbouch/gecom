<tfoot class="pagination">
  <?php
  $maxPages = 5;

  $startPage = max(1, $currentPage - floor($maxPages / 2));
  $endPage = min($totalPages, $startPage + $maxPages - 1);

  for ($i = $startPage; $i <= $endPage; $i++) : ?>
    <a href="/<?= $section ?>?page=<?= $i ?>" <?= $currentPage == $i ? 'class="active"' : '' ?>><?= $i ?></a>
  <?php endfor; ?>
</tfoot>