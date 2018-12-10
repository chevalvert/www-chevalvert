<?php snippet('site.header') ?>
<?php snippet('barba.header') ?>
<?php snippet('menu') ?>

<?php foreach ($projects as $project) {
  snippet('project.preview', compact('project'));
} ?>

<?php snippet('barba.footer') ?>
<?php snippet('footer') ?>
<?php snippet('site.footer') ?>
