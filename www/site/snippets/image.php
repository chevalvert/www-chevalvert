<?php
  $ratio = $ratio ?? $image->ratio();
  $width = min($width ?? $image->width(), $image->width());
  $height = $height ?? round($width / $ratio);
  $quality = $quality ?? 100;
  $crop = $crop ?? false;

  $alt = isset($alt) ? Escape::html($alt) : tt('alt.schema', ['projectTitle' => $image->parent()->title()]);
  $title = $title ?? Escape::html($image->caption());
  $class = $class ?? '';
  $attributes = $attributes ?? [];

  $allow_fullscreen = $allow_fullscreen ?? false;
  $lazyload = $lazyload ?? false;

  $srcset = ($image->extension() != 'gif')
    ? (isset($srcset) ? make_srcset($image, $srcset, compact('quality', 'crop', 'ratio')) : null)
    : null;
  $image = ($image->extension() != 'gif')
    ? $image->thumb(compact('width', 'height', 'quality', 'crop'))
    : $image;
  $full = ($image->extension() != 'gif')
    ? $image->original()->resize(1920)
    : $image;
?>

<?php if ($allow_fullscreen) : ?>
<a href="<?= $full->url() ?>" data-caption="<?= $title ?>" data-fullscreen="<?= $full->url() ?>">
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
        <?= r($srcset, "data-srcset='$srcset'") ?>
      <?php else : ?>
        src="<?= $image->url() ?>"
        <?= r($srcset, "srcset='$srcset'") ?>
      <?php endif ?>
    />
    <noscript><img src="<?= $image->url() ?>" <?= r($alt, 'alt="'.$alt.'"') ?> <?= r($title, 'title="'.$title.'"') ?>/></noscript>
  </figure>

<?php if ($allow_fullscreen) : ?>
</a>
<?php endif ?>
