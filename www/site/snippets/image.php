<?php
  $quality = isset($quality) ? $quality : c::get('thumbnail.quality');
  $ratio = isset($ratio) ? $ratio : $image->ratio();

  $minwidth = isset($width) ? $width : c::get('thumbnail.maxSize');
  $width = min($minwidth, $image->width());
  $height = isset($height) ? $height : $width / $ratio;

  $alt = isset($alt)
    ? $alt
    : $image->caption();
  $title = isset($title) ? $title : $alt;
  $image = $image->focusCrop($width, $height, compact('quality'));
  $linkable = isset($linkable) ? $linkable : false;
?>

<?php if ($linkable) : ?>
<a href="<?= $image->original()->url() ?>" data-zoom="<?= $image->original()->url() ?>">
<?php endif ?>

  <img
    class="<?= isset($class) ? $class : '' ?>"
    width="<?= $image->width() ?>"
    height="<?= $image->height() ?>"
    <?= r($alt, 'alt="'.$alt.'"') ?>
    <?= r($title, 'title="'.$title.'"') ?>

    <?php if (isset($attributes)) {
      foreach ($attributes as $attribute => $value) {
        echo $attribute . '="'. $value .'"';
      }
    } ?>

    <?php if (isset($lazy) && $lazy) {
      echo 'data-lozad ';
      echo 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" ';
      echo 'data-src="' . $image->url() . '" ';
    } else {
      echo 'src="' . $image->url() . '" ';
    } ?>
  />
  <noscript><img src="<?= $image->url() ?>" <?= r($alt, 'alt="'.$alt.'"') ?> <?= r($title, 'title="'.$title.'"') ?>/></noscript>

<?php if ($linkable) : ?>
</a>
<?php endif ?>
