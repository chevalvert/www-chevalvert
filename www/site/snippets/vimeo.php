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
  <a class="vimeo__link" title="<?= Escape::html($title) ?>" href="<?= $vimeo->externalUrl() ?>"></a>
  <?php endif ?>

  <?php if ($vimeo->hasCover()) {
    snippet('image', array_merge(option('project.media.presets.vimeo-cover'), [
      'class' => 'vimeo__cover',
      'image' => $vimeo->cover(),
      'ratio' => $ratio,
    ]));
  } ?>


  <iframe
    data-ratio="<?= number_format((1 / $ratio), 4) ?>"
    class="<?= r($autoplay, 'no-gui') ?> <?= $class ?>"
    title="<?= Escape::html($title) ?>"
    width="<?= $width ?>"
    height="<?= $height ?>"

    <?php if ($lazyload) : ?>
      data-lozad
      data-src="<?= $vimeo->src(['ui' => false, 'autoplay' => $autoplay]) ?>"
    <?php else : ?>
      src="<?= $vimeo->src(['ui' => false, 'autoplay' => $autoplay]) ?>"
    <?php endif ?>


    <?php foreach ($attributes as $attribute => $value) : ?>
      <?= "$attribute=\"$value\" " ?>
    <?php endforeach ?>

    <?= r($autoplay, 'allow="autoplay"') ?>
    frameborder="0"
    webkitallowfullscreen
    mozallowfullscreen
    allowfullscreen>
  </iframe>
</div>
