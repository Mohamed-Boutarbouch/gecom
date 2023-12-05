<tr>
  <?php foreach ($columns as $column) : ?>
    <th><?= $column ?></th>
  <?php endforeach; ?>
  <th colspan="<?= $section === 'bons_livraisons' ? '3' : '2' ?>">Action</th>
</tr>
</thead>