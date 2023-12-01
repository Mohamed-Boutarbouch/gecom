<form action="/<?= $section ?>/modifier" method="POST">
  <fieldset>
    <legend>Modifier <?= $section ?>:</legend>
    <input type="hidden" name="_method" value="PUT" />
    <?php foreach ($record as $key => $value) : ?>
      <?php if ($key === 'id') : ?>
        <label for="<?= $key ?>">Id</label>
        <input type="text" id="<?= $key ?>" name="<?= $key ?>" value="<?= $value ?>" readonly />
      <?php else : ?>
        <?php if ($key === 'admin') : ?>
          <label for="<?= $key ?>"><?= ucfirst($key) ?></label>
          <select name="<?= $key ?>" id="<?= $key ?>">
            <option value="0" <?= $value === 0 ? 'selected' : '' ?>>Non</option>
            <option value="1" <?= $value === 1 ? 'selected' : '' ?>>Oui</option>
          </select>
        <?php else : ?>
          <label for="<?= $key ?>"><?= ucfirst($key) ?></label>
          <input type="text" id="<?= $key ?>" name="<?= $key ?>" value="<?= $value ?>" />
        <?php endif; ?>
      <?php endif; ?>
      <br />
    <?php endforeach; ?>
    <br />
    <button>Edit</button>
  </fieldset>
</form>