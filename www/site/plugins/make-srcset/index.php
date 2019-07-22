<?php

function make_srcset($image, $widths, $quality = 100) {
  $srcset = '';
  foreach ($widths as $width) {
    $thumb = $image->thumb(compact('width', 'quality'));
    $srcset .= $thumb->url() . ' ';
    $srcset .= $width . 'w';
    $srcset .= ', ';
  }

  return rtrim($srcset, ', ');
}
