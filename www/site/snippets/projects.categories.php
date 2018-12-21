<?php $lang = $site->language()->code() ?>

<ul class="projects-categories">
  <li>
    <a class="<?= r(!$param_category, 'is-active') ?>" href="<?= url('./') ?>">
      <?= l('categories.all') ?>
    </a>
  </li>

  <?php foreach ($categories as $category) : ?>
  <li>
    <a class="<?= r($param_category === str::slug(getCategory($category)), 'is-active') ?>" href="<?= url('./' . url::paramsToString(['type' => str::slug(getCategory($category))])) ?>">
      <?= html(str::lower(getCategory($category))) ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>
