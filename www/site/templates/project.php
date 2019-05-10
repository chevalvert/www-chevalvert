<?php snippet('html/header') ?>
<?php snippet('barba/header') ?>
<?php snippet('menu') ?>

<article class="project">
  <header class="project__header" style="background-color:#<?= $page->color()->value() ?>" data-contrast="<?= Contrast::compute('#' . $page->color()->value()) ?>">
    <div class="project__header-column">
      <h1><?= $page->title()->html() ?></h1>
    </div>
    <div class="project__header-column">
      <?php snippet('project-categories', ['project' => $page, 'linkable' => true]) ?>
    </div>
    <div class="project__header-column">
      <?php snippet('project-date', ['project' => $page]) ?>
    </div>
  </header>

  <section class="project__gallery">
    <?php snippet('project-gallery', ['project' => $page]) ?>
  </section>

  <section class="project__body">
    <div class="project__body-column"><?php snippet('project-metas', ['project' => $page]) ?></div>
    <div class="project__body-column"><?= $page->text()->kirbytext() ?></div>
    <div class="project__body-column"><?= $page->aside()->kirbytext() ?></div>
  </section>

  <footer class="project__footer">
    <?php snippet('project-related', ['project' => $page]) ?>
  </footer>
</article>

<?php snippet('barba/footer') ?>
<?php snippet('footer') ?>
<?php snippet('html/footer') ?>
