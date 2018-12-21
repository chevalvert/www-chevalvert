<?php snippet('site.header') ?>
<?php snippet('barba.header') ?>
<?php snippet('menu') ?>

<div class="projects-list">
  <header class="projects-list__header">
    <div class="projects-list__header-label">
      <span class="is-sorting" data-sort="ASC"><?= l('projects-list.name') ?></span>
    </div>
    <div class="projects-list__header-label">
      <span><?= l('projects-list.type') ?></span>
      <?php snippet('projects.categories', compact('categories', 'param_category')) ?>
    </div>
    <div class="projects-list__header-label">
      <span><?= l('projects-list.date') ?></span>
    </div>
  </header>

  <ul class="projects-list__items">
    <?php foreach ($projects as $project) : ?>
    <li class="projects-list__item">
      <div class="projects-list__item-cover">
        <?php
          if ($project->vimeo()->isNotEmpty()) {
            snippet('vimeo', [
              'url' => $project->vimeo(),
              'autoplay' => true,
              'linkable' => false,
              'lazy' => true
            ]);
          } else {
            snippet('image', [
              'image' => $project->image($project->cover()),
              'width' => 500,
              'quality' => 70,
              'lazy' => true
            ]);
          }
        ?>
      </div>
      <a href="<?= $project->url() ?>">
        <div class="projects-list__item-title" data-label="<?= l('projects-list.name') ?>">
          <?= $project->title()->html() ?>
        </div>
        <div class="projects-list__item-type" data-label="<?= l('projects-list.type') ?>">
          <?php snippet('project.categories', compact('project')) ?>
        </div>
        <div class="projects-list__item-date" data-label="<?= l('projects-list.date') ?>">
          <?php snippet('project.date', compact('project')) ?>
        </div>
      </a>
    </li>
    <?php endforeach ?>
  </ul>

</div>

<?php snippet('barba.footer') ?>
<?php snippet('footer') ?>
<?php snippet('site.footer') ?>
