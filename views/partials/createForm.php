<form action="/<?= $section ?>/enregistrer" method="POST">
  <fieldset>
    <legend>Ajouter <?= $section ?>:</legend>
    <?php foreach ($columns as $column) : ?>
      <?php if ($column === 'admin') : ?>
        <label for="<?= $column ?>"><?= ucfirst($column) ?></label>
        <select name="<?= $column ?>" id="<?= $column ?>">
          <option value="0">Non</option>
          <option value="1">Oui</option>
        </select>
      <?php elseif (isset($relationships) && detectForeignKeys($relationships, $foreignKeys, $column)) : ?>
        <?php foreach ($relationships as $key => $relationship) : ?>
          <label for="<?= $key ?>"><?= getRelatedTableNameByFK($key, $foreignKeys) ?></label>
          <select id="<?= $key ?>" name="<?= $key ?>">
            <option></option>
            <?php foreach ($relationship as $data) : ?>
              <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
            <?php endforeach; ?>
          </select>
        <?php endforeach; ?>
        <br />
      <?php else : ?>
        <label for="<?= $column ?>"><?= ucfirst($column) ?></label>
        <input type="text" id="<?= $column ?>" name="<?= $column ?>" />
      <?php endif; ?>
      <br />
    <?php endforeach; ?>
    <br />
    <button>Ajouter</button>
  </fieldset>
</form>