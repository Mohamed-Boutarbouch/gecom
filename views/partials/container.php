<section>
  <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
  <select type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>">
    <option></option>
    <?php foreach ($relValue as $option) : ?>
      <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
    <?php endforeach; ?>
  </select>
  <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
  <select type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>">
    <option></option>
    <?php foreach ($relValue as $option) : ?>
      <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
    <?php endforeach; ?>
  </select>
  <br />
  <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
  <input type="date" id="<?= $fieldName ?>" name="<?= $fieldName ?>" />
  <br />
  <button>Search</button>
</section>