<table>
  <caption><?= $caption ?></caption>
  <p>
    <a href="/<?= $section ?>/creer">Ajouter</a>
  </p>
  <thead>
    <tr>
      <?php foreach ($columns as $column) : ?>
        <th><?= $column ?></th>
      <?php endforeach; ?>
      <th colspan="<?= $section === 'bon_livraison' ? '3' : '2' ?>">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($records as $record) : ?>
      <tr>
        <?php foreach ($record as $data) : ?>
          <td><?= $data ?></td>
        <?php endforeach; ?>
        <td>
          <form action="/<?= $section ?>/editer">
            <input type="hidden" name="id" value="<?= $record['id'] ?>">
            <button>Editer</button>
          </form>
        </td>
        <td>
          <form action="/<?= $section ?>/supprimer" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $record['id'] ?>">
            <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')">Supprimer</button>
          </form>
        </td>
        <?php if ($section === 'bon_livraison') : ?>
          <td>
            <form action="/detail-bl" method="GET">
              <input type="hidden" name="id" value="<?= $record['id'] ?>">
              <button>Detail</button>
            </form>
          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
    </tr>
  </tbody>
</table>