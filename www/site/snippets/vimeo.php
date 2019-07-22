<?php
  $ratio = $ratio ?? $vimeo->ratio();
  $width = isset($width) ? min($width, $vimeo->width()) : $vimeo->width();
  $height = $height ?? $width / $ratio;

  $alt = isset($alt) ? Escape::html($alt) : Escape::html($vimeo->caption());
  $title = $title ?? $vimeo->title()->value();
  $class = $class ?? '';
  $attributes = $attributes ?? [];

  $allow_fullscreen = $allow_fullscreen ?? false;
  $lazyload = $lazyload ?? false;
  $autoplay = $autoplay ?? false;
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

    width="<?= $width ?>"
    height="<?= $height ?>"

    <?php if ($lazyload) : ?>
      data-lozad
      src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 <?= intval($width) ?> <?= intval($height) ?>'%3E%3C/svg%3E"
      data-src="<?= $vimeo->src(['ui' => false, 'autoplay' => $autoplay]) ?>"
    <?php else : ?>
      src="<?= $vimeo->src(['ui' => false, 'autoplay' => $autoplay]) ?>"
    <?php endif ?>


    <?php foreach ($attributes as $attribute => $value) : ?>
      <?= "$attribute=\"$value\" " ?>
    <?php endforeach ?>

    frameborder="0"
    webkitallowfullscreen
    mozallowfullscreen
    allowfullscreen>
  </iframe>
</div>
