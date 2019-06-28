<?php
  $ratio = isset($ratio) ? $ratio : $vimeo->ratio();
  $width = isset($width) ? min($width, $vimeo->width()) : $vimeo->width();
  $height = isset($height) ? $height : $width / $ratio;

  $alt = isset($alt) ? Escape::html($alt) : Escape::html($vimeo->caption());
  $title = isset($title) ? $title : $vimeo->title()->value();
  $class = isset($class) ? $class : '';
  $attributes = isset($attributes) ? $attributes : [];

  $allow_fullscreen = isset($allow_fullscreen) ? $allow_fullscreen : false;
  $autoplay = isset($autoplay) ? $autoplay : false;
?>

<div
  <?= r($alt, "data-caption='$alt'") ?>
  <?= r($allow_fullscreen, 'data-fullscreen="'. $vimeo->src(['ui' => true, 'autoplay' => false]) .'"') ?>
  class="vimeo"
  style="padding-top:<?= number_format((1 / $ratio) * 100, 2) ?>%"
>
  <?php if ($allow_fullscreen) : ?>
  <a class="vimeo__link" title="<?= $title ?>" href="<?= $vimeo->externalUrl() ?>"></a>
  <?php endif ?>

  <iframe
    data-ratio="<?= number_format((1 / $ratio), 4) ?>"
    class="<?= $class ?> <?= r($autoplay, 'no-gui') ?>"
    src="<?= $vimeo->src(['ui' => false, 'autoplay' => $autoplay]) ?>"

    width="<?= $width ?>"
    height="<?= $height ?>"

    <?php foreach ($attributes as $attribute => $value) : ?>
      <?= "$attribute=\"$value\" " ?>
    <?php endforeach ?>

    frameborder="0"
    webkitallowfullscreen
    mozallowfullscreen
    allowfullscreen>
  </iframe>
</div>
