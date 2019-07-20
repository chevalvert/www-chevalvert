<?php
  function extractNumbers ($str) {
    preg_match_all('/\d+/', $str, $matches);
    return $matches[0];
  }

  // NOTE: in some column ratio cases, an empty div must be added in order to
  // get the proper padding-right configuration on the previous column
  // This is due to the fact that the outer columns of the gallery do not have
  // gutter… Thanks Patrick !
  function padHack () {
    echo '<li class="grid__padding-right--hack"></li>';
  }
?>

<ul class="project-gallery">
<?php foreach ($project->gallery()->toBuilderBlocks() as $line) : ?>
  <div class="project-gallery__row" data-ratio="<?= $line->ratio() ?>">
    <?php
      $widths = extractNumbers($line->ratio());
      switch ($line->_key()) {
        case 'one':
          snippet('project-gallery__media', array_merge(['key' => 'media_1', 'cols' => $widths[0]], compact('project', 'line')));
          break;

        case 'two':
          snippet('project-gallery__media', array_merge(['key' => 'media_1', 'cols' => $widths[0]], compact('project', 'line')));
          snippet('project-gallery__media', array_merge(['key' => 'media_2', 'cols' => $widths[1]], compact('project', 'line')));
          break;

        case 'three':
          snippet('project-gallery__media', array_merge(['key' => 'media_1', 'cols' => $widths[0]], compact('project', 'line')));
          snippet('project-gallery__media', array_merge(['key' => 'media_2', 'cols' => $widths[1]], compact('project', 'line')));
          snippet('project-gallery__media', array_merge(['key' => 'media_3', 'cols' => $widths[2]], compact('project', 'line')));
          break;
      }

      if (array_sum($widths) < 16) padHack();
    ?>
  </div>
<?php endforeach ?>
</ul>
