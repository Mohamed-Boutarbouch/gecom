<form action="/<?= $section ?>/modifier" method="POST">
  <fieldset>
    <legend>Modifier <?= $section ?>:</legend>
    <input type="hidden" name="_method" value="PUT" />
    <?php foreach ($record as $fieldName => $value) : ?>
      <?php if ($fieldName === 'id') : ?>
        <label for="<?= $fieldName ?>">Id</label>
        <input type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>" value="<?= $value ?>" readonly />
      <?php else : ?>
        <?php if ($fieldName === 'admin') : ?>
          <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
          <select name="<?= $fieldName ?>" id="<?= $fieldName ?>">
            <option value="0" <?= $value === 0 ? 'selected' : '' ?>>Non</option>
            <option value="1" <?= $value === 1 ? 'selected' : '' ?>>Oui</option>
          </select>
        <?php elseif (isset($relationships) && detectForeignKeys($relationships, $foreignKeys, $fieldName)) : ?>
          <?php foreach ($relationships as $key => $relationship) : ?>
            <label for="<?= $key ?>"><?= getRelatedTableNameByFK($key, $foreignKeys) ?></label>
            <select id="<?= $key ?>" name="<?= $key ?>">
              <?php foreach ($relationship as $data) : ?>
                <option value="<?= $data['id'] ?>" <?= $value === $data['id'] ? 'selected' : '' ?>><?= $data['name'] ?></option>
              <?php endforeach; ?>
            </select>
          <?php endforeach; ?>
          <br />
        <?php else : ?>
          <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
          <input type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>" value="<?= $value ?>" />
        <?php endif; ?>
      <?php endif; ?>
      <br />
    <?php endforeach; ?>
    <br />
    <button>Edit</button>
  </fieldset>
</form>