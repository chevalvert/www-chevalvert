<?php snippet('html/header') ?>
<?php snippet('barba/header') ?>
<?php snippet('menu') ?>

<section class="default">
  <div class="default__column">
    <h1><?= $page->title()->html() ?></h1>
  </div>
  <div class="default__column">
    <div class="sitemap"><?= $sitemap ?></div>
  </div>
</section>

<?php snippet('barba/footer') ?>
<?php snippet('footer') ?>
<?php snippet('html/footer') ?>
