<?php if ($project->vimeo()->isNotEmpty() || $project->cover()->isNotEmpty()) : ?>
<section class="project-preview">
  <a href="<?= $project->url() ?>" title="<?= $project->title() ?>">
    <figure class="project-preview__cover">
      <?php
        if ($project->vimeo()->isNotEmpty()) {
          snippet('vimeo', [
            'url' => $project->vimeo(),
            'playback_offset' => r($project->vimeo_playback_offset()->isNotEmpty(), $project->vimeo_playback_offset()->int()),
            'autoplay' => true,
            'linkable' => false,
            'ratio' => 16/9,
            // NOTE: UX is improved when video is already playing
            // when appearing in viewport, so no lazyloading for now
            'lazy' => false
          ]);
        } else {
          snippet('image', [
            'image' => $project->image($project->cover()),
            'width' => 1920,
            'ratio' => 16/9,
            'quality' => 70,
            // NOTE: no title on image because wrapping <a> already has one
            'title' => false,
            'lazy' => true
          ]);
        }
      ?>
    </figure>

    <header class="project-preview__header">
      <div class="project__header-column">
        <h1><?= $project->title()->html() ?></h1>
      </div>
      <div class="project__header-column">
        <?php snippet('project.categories', compact('project')) ?>
      </div>
      <div class="project__header-column">
        <?php snippet('project.date', compact('project')) ?>
      </div>
    </header>
  </a>
</section>
<?php endif ?>
