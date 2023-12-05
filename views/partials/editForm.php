<form action="/<?= $section ?>/modifier" method="POST">
  <fieldset>
    <legend>Modifier <?= $section ?>:</legend>
    <input type="hidden" name="_method" value="PUT" />
    <?php foreach ($record['data'] as $fieldKey => $fieldValue) : ?>
      <?php if ($fieldKey === 'id') : ?>
        <label for="<?= $fieldKey ?>">Id</label>
        <input type="text" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>" readonly />
        <br />
      <?php elseif (isBooleanValueField($fieldKey)) : ?>
        <label for="<?= $fieldKey ?>"><?= ucfirst($fieldKey) ?></label>
        <select name="<?= $fieldKey ?>" id="<?= $fieldKey ?>">
          <option value="0" <?= $fieldValue === 0 ? 'selected' : '' ?>>Non</option>
          <option value="1" <?= $fieldValue === 1 ? 'selected' : '' ?>>Oui</option>
        </select>
        <br />
      <?php elseif ($fieldKey === 'date') : ?>
        <label for="<?= $fieldKey ?>"><?= ucfirst($fieldKey) ?></label>
        <input type="date" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>" />
        <br />
      <?php elseif (!array_key_exists($fieldKey, $record['relationships'])) : ?>
        <label for="<?= $fieldKey ?>"><?= $fieldKey ?></label>
        <input type="text" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>">
        <br />
      <?php else : ?>
        <?php foreach ($record['relationships'] as $relKey => $relValue) : ?>
          <?php if ($relKey === $fieldKey) : ?>
            <label for="<?= $fieldKey ?>"><?= ucfirst($fieldKey) ?></label>
            <select type="text" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>">
              <?php foreach ($relValue as $option) : ?>
                <option value="<?= $option['id'] ?>" <?= $option['id'] === $fieldValue ? 'selected' : '' ?>><?= $option['name'] ?></option>
              <?php endforeach; ?>
            </select>
            <br />
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    <button>Edit</button>
  </fieldset>
</form>