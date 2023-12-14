<?php require 'partials/head.php' ?>
<?php require 'partials/navigation.php' ?>
<?php require 'partials/container.php' ?>
<?php // require 'partials/editForm.php' 
?>
<?php require 'partials/search.php' ?>
<?php require 'partials/table/index.php' ?>
<?php require 'partials/footer.php' ?>
<div class="m-6">
  <label for="prix" class="block text-sm font-medium text-gray-700">PRIX TOTAL</label>
  <input type="text" class="w-80 rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="prix" id="prix" value="<?= $finalTotal ?>" disabled />
</div>