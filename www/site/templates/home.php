<?php snippet('html/header') ?>
<?php snippet('barba/header') ?>
<?php snippet('menu') ?>

<?php foreach ($projects as $project) {
  snippet('project-preview', [
    'project' => $project,
    'cover_preset' => 'home'
  ]);
} ?>

<?php snippet('barba/footer') ?>
<?php snippet('footer') ?>
<?php snippet('html/footer') ?>
