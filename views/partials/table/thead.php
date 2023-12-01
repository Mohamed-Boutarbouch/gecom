<tr>
  <?php foreach ($columns as $column) : ?>
    <th><?= $column ?></th>
  <?php endforeach; ?>
  <th colspan="<?= $section === 'bon_livraison' ? '3' : '2' ?>">Action</th>
</tr>
</thead>