<tr class="border-b">
  <?php foreach ($columns as $column) : ?>
    <th class="text-left p-3 px-5 capitalize text-gray-300"><?= $column ?></th>
  <?php endforeach; ?>
  <th class="text-left p-3 px-5 capitalize text-gray-300" colspan="<?= $section === 'bons_livraisons' ? '3' : '2' ?>">Action</th>
</tr>
</thead>