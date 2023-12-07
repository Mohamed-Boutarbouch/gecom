<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <a href="/" class="<?= urlIs('/') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Familles</a>
            <a href="/clients" class="<?= urlIs('/clients') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium">Clients</a>
            <a href="/caissiers" class="<?= urlIs('/caissiers') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium">Caissiers</a>
            <a href="/modes_reglement" class="<?= urlIs('/modes_reglement') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium">Mode Reglement</a>
            <span class="h-px mx-8 text-white">|</span>
            <a href="/articles" class="<?= urlIs('/articles') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium">Articles</a>
            <a href="/reglements" class="<?= urlIs('/reglements') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium">Reglements</a>
            <a href="/bons_livraisons" class="<?= urlIs('/bons_livraisons') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium">Bons Livraisons</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
<p>
  <a href="/<?= $section ?>/creer">Ajouter des <?= ucfirst($section) ?></a>
</p>