<?php snippet('html/header') ?>
<?php snippet('barba/header') ?>
<?php snippet('menu') ?>

<div class="projects">
  <header class="projects__header">
    <?php snippet('projects-categories', compact('categories')) ?>
  </header>

  <ul class="projects__items">
    <?php foreach ($projects as $project) {
      snippet('project-preview', [
        'project' => $project,
        'cover_preset' => 'projects',
        'show_categories' => false
      ]);
    } ?>
  </ul>
</div>

<?php snippet('barba/footer') ?>
<?php snippet('footer') ?>
<?php snippet('html/footer') ?>
