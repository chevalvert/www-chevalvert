<ul class="projects-categories">
  <li>
    <a class="<?= r(!param('category', false), 'is-active') ?>" href="<?= $page->url() ?>">
      <?= t('categories.all') ?>
    </a>
  </li>

  <?php foreach ($categories as $category) : ?>
  <li>
    <?php snippet('category', [
      'category' => $category,
      'linkable' => true
    ]) ?>
  </li>
  <?php endforeach ?>
</ul>
