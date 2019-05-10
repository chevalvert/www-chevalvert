<?php

function getTopLevelPage ($page) {
  if ($page->depth() === 1) return $page;

  $parents = $page->parents();
  return $parents->last();
}

return function ($page) {
  function walk ($parent = null) {
    $sitemap = '<ul>';
    foreach ($parent as $child) {
      if (in_array(getTopLevelPage($child)->uri(), option('sitemap.ignore'))) continue;

      $sitemap .= '<li>';
      $sitemap .= '<a href="'. $child->url() .'">'. $child->title()->html() .'</a>';
      if ($child->hasVisibleChildren()) $sitemap .= walk($child->children()->visible());
      $sitemap .= '</li>';
    }
    $sitemap .= '</ul>';
    return $sitemap;
  }

  $sitemap = walk(site()->pages());
  return compact('sitemap');
};
