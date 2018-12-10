<?php snippet('site.header') ?>
<?php snippet('barba.header') ?>
<?php snippet('menu') ?>

<article class="project">
  <header class="project__header">
    <div class="project__header-column">
      <h1><?= $page->title()->html() ?></h1>
    </div>
    <div class="project__header-column">
      <?php snippet('project.categories', ['project' => $page]) ?>
    </div>
    <div class="project__header-column">
      <?php snippet('project.date', ['project' => $page]) ?>
    </div>
  </header>

  <section class="project__body">
    <div class="project__body-column">
      <?php snippet('project.metas', ['project' => $page]) ?>
    </div>
    <div class="project__body-column">
      <?= $page->text()->kirbytext() ?>
    </div>
    <div class="project__body-column">
      <?php snippet('project.links', ['project' => $page]) ?>
    </div>
  </section>

  <section class="project__gallery">
    <?php snippet('project.gallery', ['project' => $page]) ?>
  </section>

</article>


<?php snippet('barba.footer') ?>
<?php snippet('footer') ?>
<?php snippet('site.footer') ?>
