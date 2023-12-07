<?php if (!empty($paginate)) : ?>
  <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Page
          <span class="font-medium"><?= $paginate['currentPageNumber'] ?></span>
          sur
          <span class="font-medium"><?= $paginate['totalPages'] ?></span>
        </p>
      </div>

      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <a <?= ($paginate['currentPageNumber'] > 1) ? "href='?page={$paginate['previousPage']}'" : '' ?> class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
          </a>

          <?php
          if ($paginate['totalPages'] < 10) {
            for ($counter = 1; $counter <= $paginate['totalPages']; $counter++) {
              if ($counter === $paginate['currentPageNumber']) {
                echo "<a href='#' class='relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>$counter</a>";
              } else {
                echo "<a href='?page=$counter' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>$counter</a>";
              }
            }
          }
          if ($paginate['currentPageNumber'] <= 4) {
            for ($counter = 1; $counter < 8; $counter++) {
              if ($counter == $paginate['currentPageNumber']) {
                echo "<a href='#' class='relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>$counter</a>";
              } else {
                echo "<a href='?page=$counter' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>$counter</a>";
              }
            }
            echo "<span class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0'>...</span>";
            echo "<a href='?page={$paginate['secondLast']}' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>{$paginate['secondLast']}</a>";
            echo "<a href='?page={$paginate['totalPages']}' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>{$paginate['totalPages']}</a>";
          } elseif ($paginate['currentPageNumber'] > 4 && $paginate['currentPageNumber'] < $paginate['totalPages'] - 4) {
            echo "<a href='?page=1' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>1</a>";
            echo "<a href='?page=2' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>2</a>";
            echo "<span class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0'>...</span>";
            for (
              $counter = $paginate['currentPageNumber'] - $paginate['adjacent'];
              $counter <= $paginate['currentPageNumber'] + $paginate['adjacent'];
              $counter++
            ) {
              if ($counter == $paginate['currentPageNumber']) {
                echo "<a href='#' class='relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>$counter</a>";
              } else {
                echo "<a href='?page=$counter' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>$counter</a>";
              }
            }
            echo "<span class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0'>...</span>";
            echo "<a href='?page={$paginate['secondLast']}' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>{$paginate['secondLast']}</a>";
            echo "<a href='?page={$paginate['totalPages']}' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>{$paginate['totalPages']}</a>";
          } else {
            echo "<a href='?page=1' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>1</a>";
            echo "<a href='?page=2' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>2</a>";
            echo "<span class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0'>...</span>";
            for (
              $counter = $paginate['totalPages'] - 6;
              $counter <= $paginate['totalPages'];
              $counter++
            ) {
              if ($counter == $paginate['currentPageNumber']) {
                echo "<a href='#' class='relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>$counter</a>";
              } else {
                echo "<a href='?page=$counter' class='relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0'>$counter</a>";
              }
            }
          }
          ?>

          <a <?= ($paginate['currentPageNumber'] < $paginate['totalPages']) ? "href='?page={$paginate['nextPage']}'" : '' ?> class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
          </a>
      </div>
    </div>
  <?php endif; ?>