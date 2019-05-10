<?php
  $ratio = isset($ratio) ? $ratio : $image->ratio();
  $width = min($width, $image->width());
  $height = isset($height) ? $height : $width / $ratio;
  $quality = isset($quality) ? $quality : 100;

  $alt = isset($alt) ? $alt : $image->caption();
  $title = isset($title) ? $title : $alt;
  $class = isset($class) ? $class : '';
  $attributes = isset($attributes) ? $attributes : [];

  $allow_fullscreen = isset($allow_fullscreen) ? $allow_fullscreen : false;
  $lazyload = isset($lazyload) ? $lazyload : false;

  $image = $image->focusCrop($width, $height, compact('quality'));
?>

<?php if ($allow_fullscreen) : ?>
<a href="<?= $image->original()->url() ?>" data-caption="<?= $alt ?>" data-fullscreen="<?= $image->original()->url() ?>">
<?php endif ?>

  <figure <?= r($class, "class=\"$class\"") ?>>
    <img
      width="<?= $image->width() ?>"
      height="<?= $image->height() ?>"
      <?= r($alt, 'alt="'.$alt.'"') ?>
      <?= r($title, 'title="'.$title.'"') ?>

      <?php foreach ($attributes as $attribute => $value) : ?>
        <?= "$attribute=\"$value\" " ?>
      <?php endforeach ?>

      <?php if ($lazyload) : ?>
        data-lozad
        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 <?= $image->width() ?> <?= $image->height() ?>'%3E%3C/svg%3E"
        data-src="<?= $image->url() ?>"
      <?php else : ?>
        src="<?= $image->url() ?>"
      <?php endif ?>
    />
    <noscript><img src="<?= $image->url() ?>" <?= r($alt, 'alt="'.$alt.'"') ?> <?= r($title, 'title="'.$title.'"') ?>/></noscript>
  </figure>

<?php if ($allow_fullscreen) : ?>
</a>
<?php endif ?>
