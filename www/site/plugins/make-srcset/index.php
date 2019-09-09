<?php

function make_srcset ($image, $widths = [], $options = []) {
  $srcset = '';
  foreach ($widths as $width) {
    $height = round($width / $options['ratio']);
    $thumb = $image->thumb(array_merge(compact('width', 'height'), $options));
    $srcset .= $thumb->url() . ' ';
    $srcset .= $width . 'w';
    $srcset .= ', ';
  }

  return rtrim($srcset, ', ');
}
