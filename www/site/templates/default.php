<?php snippet('html/header') ?>
<?php snippet('barba/header') ?>
<?php snippet('menu') ?>

<article class="default">
  <div class="default__column">
    <h1><?= $page->title()->html() ?></h1>
  </div>
  <div class="default__column">
    <?= $page->text()->kirbytext() ?>
  </div>
</article>

<?php snippet('barba/footer') ?>
<?php snippet('footer') ?>
<?php snippet('html/footer') ?>
