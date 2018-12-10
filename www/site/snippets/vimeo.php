<?php
  $vimeo_id = getVimeoId($url);
  // TODO: handle private id
  $vimeo_metas = getVimeoMetas($vimeo_id);

  $tbn = ensureVimeoMeta($vimeo_metas, 'thumbnail_large', '');
  $title = ensureVimeoMeta($vimeo_metas, 'title', false);
  $width = ensureVimeoMeta($vimeo_metas, 'width', 16);
  $height = ensureVimeoMeta($vimeo_metas, 'height', 9);
  $ratio = isset($ratio) ? $ratio : $width / $height;

  $autoplay = isset($autoplay) ? $autoplay : false;
  $lazy = isset($lazy) ? $lazy : false;
  $linkable = isset($linkable) ? $linkable : true;
  $playback_offset = isset($playback_offset) ? $playback_offset : 0;

  $url_ui = "https://player.vimeo.com/video/$vimeo_id?loop=1&color=ffffff&title=0&byline=0&portrait=0";
  $url_no_ui = "https://player.vimeo.com/video/$vimeo_id?" . r($autoplay, 'autoplay=1&background=1&loop=1&') . "color=ffffff&title=0&byline=0&portrait=0" . r($playback_offset, '#t=' . $playback_offset);
?>

<div <?= r($linkable, 'data-zoom="'. $url_ui .'"') ?> class="vimeo" style="padding-top:<?= number_format((1 / $ratio) * 100, 2) ?>%; background-image:url('<?= $tbn ?>')">
  <?php if ($linkable) : ?>
  <a class="vimeo__link" <?= r($title, 'title="'.$title.'"') ?> href="<?= $url ?>"></a>
  <?php endif ?>

  <iframe
    data-ratio="<?= number_format((1 / $ratio), 4) ?>"
    class="<?= r($autoplay, 'no-gui') ?>"
    <?= r($lazy, 'data-lozad') ?>
    <?= r($lazy, 'data-') ?>src="<?= $url_no_ui ?>"
    frameborder="0"
    webkitallowfullscreen
    mozallowfullscreen
    allowfullscreen>
  </iframe>
</div>
