<?php
  /*
    | 1 : 2 :   |
    |   : 3 : 3 |
    | 4 : 4 :   |
    | 5 : 5 : 5 |
  */

  $tbn_sizes = [
    1 => 600,
    2 => 900,
    3 => 1024,
    4 => 1280,
    5 => 1920
  ];
?>

<ul class="project-gallery">
<?php foreach ($project->gallery()->toStructure() as $item) : ?>
  <?php if ($item->image()->isEmpty() && $item->vimeo()->isEmpty()) continue ?>


  <?php $layout = $item->layout()->int() + 1 ?>
  <?= r(in_array($layout, c::get('project-gallery.lineBreakerLayouts'), true), '<div class="project-gallery__line-break"></div>') ?>

  <li data-layout="<?= $layout ?>">
    <?php
      if ($item->image()->isNotEmpty()) {
        snippet('image', [
          'image' => $project->image($item->image()),
          'width' => $tbn_sizes[$layout],
          'lazy' => true,
          'linkable' => true
        ]);
      }

      if ($item->vimeo()->isNotEmpty()) {
        snippet('vimeo', [
          'url' => $item->vimeo(),
          'playback_offset' => r($item->playback_offset()->isNotEmpty(), $item->playback_offset()->int()),
          'autoplay' => true,
          'linkable' => true,
          'lazy' => false
        ]);
      }
    ?>
  </li>
<?php endforeach ?>
</ul>
