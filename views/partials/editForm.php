<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="/<?= $section ?>/modifier" method="POST">
        <legend class="text-xl mt-2">Modifier <?= $section ?>:</legend>
        <div class="shadow sm:overflow-hidden sm:rounded-md">
          <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <input type="hidden" name="_method" value="PUT" />
            <?php foreach ($record['data'] as $fieldKey => $fieldValue) : ?>
              <?php if ($fieldKey === 'id') : ?>
                <label for="<?= $fieldKey ?>" class="block text-sm font-medium text-gray-700">Id</label>
                <div class="mt-1">
                  <input type="text" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" readonly />
                </div>
              <?php elseif (isBooleanValueField($fieldKey)) : ?>
                <label for="<?= $fieldKey ?>" class="block text-sm font-medium text-gray-700 capitalize"><?= $fieldKey ?></label>
                <div class="mt-1">
                  <select name="<?= $fieldKey ?>" id="<?= $fieldKey ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="0" <?= $fieldValue === 0 ? 'selected' : '' ?>>Non</option>
                    <option value="1" <?= $fieldValue === 1 ? 'selected' : '' ?>>Oui</option>
                  </select>
                </div>
              <?php elseif ($fieldKey === 'date') : ?>
                <label for="<?= $fieldKey ?>" class="block text-sm font-medium text-gray-700 capitalize"><?= ucfirst($fieldKey) ?></label>
                <div class="mt-1">
                  <input type="date" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              <?php elseif (!array_key_exists($fieldKey, $record['relationships'])) : ?>
                <label for="<?= $fieldKey ?>" class="block text-sm font-medium text-gray-700 capitalize"><?= $fieldKey ?></label>
                <div class="mt-1">
                  <input type="text" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              <?php else : ?>
                <?php foreach ($record['relationships'] as $relKey => $relValue) : ?>
                  <?php if ($relKey === $fieldKey) : ?>
                    <label for="<?= $fieldKey ?>" class="block text-sm font-medium text-gray-700 capitalize"><?= ucfirst($fieldKey) ?></label>
                    <div class="mt-1">
                      <select type="text" id="<?= $fieldKey ?>" name="<?= $fieldKey ?>" value="<?= $fieldValue ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php foreach ($relValue as $option) : ?>
                          <option value="<?= $option['id'] ?>" <?= $option['id'] === $fieldValue ? 'selected' : '' ?>><?= $option['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            <?php endforeach; ?>
            <div class="px-4 py-3 text-right sm:px-6">
              <a href="/<?= $section ?>" class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">Annuler</a>
              <button class="inline-flex justify-center rounded-md border border-transparent bg-indigo-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">Modifier</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>