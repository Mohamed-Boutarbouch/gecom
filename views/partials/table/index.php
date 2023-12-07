<div class="mx-6 my-8">
  <a href="/<?= $section ?>/creer" class="rounded-md bg-indigo-600 px-3.5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Ajouter des <?= $section ?></a>
</div>
<div class="px-3 flex justify-center">
  <table class="w-full text-md bg-gray-800 shadow-md mb-4 rounded-md">
    <caption class="text-2xl mb-2 font-bold"><?= $caption ?></caption>
    <thead>
      <?php require 'thead.php' ?>
    </thead>
    <tbody>
      <?php require 'tbody.php' ?>
    </tbody>
  </table>
</div>
<?php require 'pagination.php' ?>