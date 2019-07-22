<li data-cols="<?= $cols ?>">
  <?php $project->media($line->$key(), [
    'quality' => 100,
    'width' => $width = option('project-gallery.layouts.thumbnail_sizes')[$cols]
  ]) ?>
</li>
