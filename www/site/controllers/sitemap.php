<?php

return function ($site, $pages, $page) {
  function walk ($parent = null) {
    $sitemap = '<ul class="sitemap">';
    foreach ($parent as $child) {
      if (in_array(getTopLevelPage($child)->uri(), c::get('sitemap.ignore'))) continue;

      $sitemap .= '<li>';
      $sitemap .= '<a href="'. $child->url() .'">'. $child->title()->html() .'</a>';
      if ($child->hasVisibleChildren()) $sitemap .= walk($child->children()->visible());
      $sitemap .= '</li>';
    }
    $sitemap .= '</ul>';
    return $sitemap;
  }

  $sitemap = walk($pages);
  return compact('sitemap');
};
