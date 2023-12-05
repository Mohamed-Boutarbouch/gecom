<form action="/<?= $section ?>/enregistrer" method="POST">
  <fieldset>
    <legend>Ajouter <?= $section ?>:</legend>
    <?php foreach ($inputFields['fields'] as $fieldName) : ?>
      <?php if (isBooleanValueField($fieldName)) : ?>
        <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
        <select name="<?= $fieldName ?>" id="<?= $fieldName ?>">
          <option value="0">Non</option>
          <option value="1">Oui</option>
        </select>
        <br />
      <?php elseif ($fieldName === 'date') : ?>
        <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
        <input type="date" id="<?= $fieldName ?>" name="<?= $fieldName ?>" />
        <br />
      <?php elseif (!array_key_exists($fieldName, $inputFields['relationships'])) :
      ?>
        <label for="<?= $fieldName ?>"><?= $fieldName ?></label>
        <input type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>" />
        <br />
      <?php else : ?>
        <?php foreach ($inputFields['relationships'] as $relKey => $relValue) : ?>
          <?php if ($relKey === $fieldName) : ?>
            <label for="<?= $fieldName ?>"><?= ucfirst($fieldName) ?></label>
            <select type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>">
              <option></option>
              <?php foreach ($relValue as $option) : ?>
                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
              <?php endforeach; ?>
            </select>
            <br />
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    <button>Ajouter</button>
  </fieldset>
</form>