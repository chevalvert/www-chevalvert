<section class="project-preview">
  <a href="<?= $project->url() ?>" class="project-preview__header" style="background-color:#<?= $project->color()->value() ?>" data-contrast="<?= Contrast::compute('#' . $project->color()->value()) ?>">
    <?php if (isset($show_title) ? $show_title : true) : ?>
    <div class="project__header-column">
      <h3><?= $project->title()->html() ?></h3>
    </div>
    <?php endif ?>

    <?php if (isset($show_categories) ? $show_categories : true) : ?>
    <div class="project__header-column">
      <?php snippet('project-categories', compact('project')) ?>
    </div>
    <?php endif ?>

    <?php if (isset($show_date) ? $show_date : true) : ?>
    <div class="project__header-column">
      <?php snippet('project-date', compact('project')) ?>
    </div>
    <?php endif ?>
  </a>
  <a href="<?= $project->url() ?>" tabIndex="-1">
    <div class="project-preview__cover">
      <?= $project->cover(isset($cover_preset) ? $cover_preset : 'default') ?>
    </div>
  </a>
</section>
