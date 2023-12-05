<?php if (!empty($paginate)) : ?>
  <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
    <strong>Page <?php echo $paginate['currentPageNumber'] . " of " . $paginate['totalPages'] ?></strong>
  </div>

  <ul class="pagination">
    <?php if ($paginate['currentPageNumber'] > 1) : ?>
      <li>
        <a href="?page=1">First Page</a>
      </li>
    <?php endif; ?>

    <li <?= ($paginate['currentPageNumber'] <= 1) ? 'class="disabled"' : '' ?>>
      <a <?= ($paginate['currentPageNumber'] > 1) ? "href='?page={$paginate['previousPage']}'" : '' ?>>Previous</a>
    </li>

    <?php
    if ($paginate['totalPages'] <= 10) {
      for ($counter = 1; $counter <= $paginate['totalPages']; $counter++) {
        if ($counter === $paginate['currentPageNumber']) {
          echo "<li class='active'><a>$counter</a></li>";
        } else {
          echo "<li><a href='?page=$counter'>$counter</a></li>";
        }
      }
    }
    if ($paginate['currentPageNumber'] <= 4) {
      for ($counter = 1; $counter < 8; $counter++) {
        if ($counter == $paginate['currentPageNumber']) {
          echo "<li class='active'><a>$counter</a></li>";
        } else {
          echo "<li><a href='?page=$counter'>$counter</a></li>";
        }
      }
      echo "<li><a>...</a></li>";
      echo "<li><a href='?page={$paginate['secondLast']}'>{$paginate['secondLast']}</a></li>";
      echo "<li><a href='?page={$paginate['totalPages']}'>{$paginate['totalPages']}</a></li>";
    } elseif ($paginate['currentPageNumber'] > 4 && $paginate['currentPageNumber'] < $paginate['totalPages'] - 4) {
      echo "<li><a href='?page=1'>1</a></li>";
      echo "<li><a href='?page=2'>2</a></li>";
      echo "<li><a>...</a></li>";
      for (
        $counter = $paginate['currentPageNumber'] - $paginate['adjacent'];
        $counter <= $paginate['currentPageNumber'] + $paginate['adjacent'];
        $counter++
      ) {
        if ($counter == $paginate['currentPageNumber']) {
          echo "<li class='active'><a>$counter</a></li>";
        } else {
          echo "<li><a href='?page=$counter'>$counter</a></li>";
        }
      }
      echo "<li><a>...</a></li>";
      echo "<li><a href='?page={$paginate['secondLast']}'>{$paginate['secondLast']}</a></li>";
      echo "<li><a href='?page={$paginate['totalPages']}'>{$paginate['totalPages']}</a></li>";
    } else {
      echo "<li><a href='?page=1'>1</a></li>";
      echo "<li><a href='?page=2'>2</a></li>";
      echo "<li><a>...</a></li>";
      for (
        $counter = $paginate['totalPages'] - 6;
        $counter <= $paginate['totalPages'];
        $counter++
      ) {
        if ($counter == $paginate['currentPageNumber']) {
          echo "<li class='active'><a>$counter</a></li>";
        } else {
          echo "<li><a href='?page=$counter'>$counter</a></li>";
        }
      }
    }
    ?>

    <li <?= ($paginate['currentPageNumber'] >= $paginate['totalPages']) ? 'class="disabled"' : ''; ?>>
      <a <?= ($paginate['currentPageNumber'] < $paginate['totalPages']) ? "href='?page={$paginate['nextPage']}'" : '' ?>>Next</a>
    </li>

    <?php if ($paginate['currentPageNumber'] < $paginate['totalPages']) : ?>
      <li>
        <a href="?page=<?= $paginate['totalPages'] ?>">Last</a>
      </li>
    <?php endif; ?>
  </ul>
<?php endif; ?>