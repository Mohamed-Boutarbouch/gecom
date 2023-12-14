<?php foreach ($records as $record) : ?>
  <tr class="border-b hover:bg-zinc-100 bg-white">
    <?php foreach ($record as $data) : ?>
      <?php if (isset($record['qte']) && $record['qte'] === $data) : ?>
        <td class="p-3 px-5 flex items-center gap-4">
          <div><?= $record['qte'] ?></div>
          <div>
            <form method="POST">
              <input type="hidden" name="increase" value="<?= $record['id'] ?>" />
              <button class="mb-1 px-2 bg-gray-200 hover:bg-gray-600 hover:text-white rounded transition-all">&mapstoup;</button>
            </form>
            <form method="POST">
              <input type="hidden" name="decrease" value="<?= $record['id'] ?>" />
              <button class="mt-1 px-2 bg-gray-200 hover:bg-gray-600 hover:text-white rounded transition-all">&mapstodown;</button>
            </form>
          </div>
        </td>
      <?php else : ?>
        <td class="p-3 px-5"><?= $data ?></td>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($section === 'detail-bl') : ?>
      <td>
        <form method="POST">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="id" value="<?= $record['id'] ?>">
          <button class="inline-flex justify-center rounded-md border border-transparent bg-red-500 py-1.5 px-3.5 text-sm font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')">Supprimer</button>
        </form>
      </td>
    <?php endif; ?>
    <?php if ($section !== 'detail-bl') : ?>
      <td>
        <form action="/<?= $section ?>/editer">
          <input type="hidden" name="id" value="<?= $record['id'] ?>">
          <button class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-1.5 px-3.5 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">Editer</button>
        </form>
      </td>
      <td>
        <form action="/<?= $section ?>/supprimer" method="POST">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="id" value="<?= $record['id'] ?>">
          <button class="inline-flex justify-center rounded-md border border-transparent bg-red-500 py-1.5 px-3.5 text-sm font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')">Supprimer</button>
        </form>
      </td>
      <?php if ($section === 'bons_livraisons') : ?>
        <td>
          <a href="/detail-bl?bl-id=<?= $record['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
        </td>
      <?php endif; ?>
    <?php endif; ?>
  </tr>
<?php endforeach; ?>
</tr>