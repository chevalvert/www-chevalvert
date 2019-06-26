<li data-cols="<?= $cols ?>">
  <?php $project->media($line->$key(), [
    'width' => $width = option('project-gallery.layouts.thumbnail_sizes')[$cols]
  ]) ?>
</li>
