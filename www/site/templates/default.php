<?php snippet('site.header') ?>
<?php snippet('barba.header') ?>
<?php snippet('menu') ?>

<section class="about-section">
  <div class="about-section__column">
    <h2>
      <?= $page->title()->html() ?>
    </h2>
  </div>
  <div class="about-section__column">
    <?= $page->text()->kirbytext() ?>
  </div>
</section>

<?php snippet('barba.footer') ?>
<?php snippet('footer') ?>
<?php snippet('site.footer') ?>
