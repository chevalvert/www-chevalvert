<section class="project-preview">
  <a href="<?= $project->url() ?>" class="project-preview__header" style="background-color:#<?= $project->color()->value() ?>" data-contrast="<?= Contrast::compute('#' . $project->color()->value()) ?>">
    <?php if ($show_title ?? true) : ?>
    <div class="project__header-column">
      <h3><?= $project->title()->html() ?></h3>
    </div>
    <?php endif ?>

    <?php if ($show_categories ?? true) : ?>
    <div class="project__header-column">
      <?php snippet('project-categories', compact('project')) ?>
    </div>
    <?php endif ?>

    <?php if ($show_date ?? true) : ?>
    <div class="project__header-column">
      <?php snippet('project-date', compact('project')) ?>
    </div>
    <?php endif ?>
  </a>
  <a href="<?= $project->url() ?>" tabIndex="-1">
    <div class="project-preview__cover">
      <?= $project->cover($cover_preset ?? 'default') ?>
    </div>
  </a>
</section>
