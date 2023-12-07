<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="/<?= $section ?>/enregistrer" method="POST">
        <div class="shadow sm:overflow-hidden sm:rounded-md">
          <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <?php foreach ($inputFields['fields'] as $fieldName) : ?>
              <?php if (isBooleanValueField($fieldName)) : ?>
                <label for="<?= $fieldName ?>" class="block text-sm font-medium text-gray-700"><?= ucfirst($fieldName) ?></label>
                <div class="mt-1">
                  <select name="<?= $fieldName ?>" id="<?= $fieldName ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                  </select>
                </div>
              <?php elseif ($fieldName === 'date') : ?>
                <label for="<?= $fieldName ?>" class="block text-sm font-medium text-gray-700"><?= ucfirst($fieldName) ?></label>
                <div class="mt-1">
                  <input type="date" id="<?= $fieldName ?>" name="<?= $fieldName ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              <?php elseif (!array_key_exists($fieldName, $inputFields['relationships'])) :
              ?>
                <label for="<?= $fieldName ?>" class="block text-sm font-medium text-gray-700"><?= ucfirst($fieldName) ?></label>
                <div class="mt-1">
                  <input type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              <?php else : ?>
                <?php foreach ($inputFields['relationships'] as $relKey => $relValue) : ?>
                  <?php if ($relKey === $fieldName) : ?>
                    <label for="<?= $fieldName ?>" class="block text-sm font-medium text-gray-700"><?= ucfirst($fieldName) ?></label>
                    <div class="mt-1">
                      <select type="text" id="<?= $fieldName ?>" name="<?= $fieldName ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option></option>
                        <?php foreach ($relValue as $option) : ?>
                          <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            <?php endforeach; ?>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <button class="inline-flex justify-center rounded-md border border-transparent bg-indigo-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">Ajouter</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>