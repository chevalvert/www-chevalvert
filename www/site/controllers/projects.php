<?php

return function ($site, $pages, $page) {
  $param_category = param('type', false);
  $projects = $page->children()->visible()->filter(function ($p) use ($param_category) {
    if (!$param_category) return true;
    $found = false;
    foreach ($p->categories()->split() as $category) {
      if ($param_category === str::slug(getCategory($category))) {
        $found = true;
        break;
      };
    }
    return $found;
  })->sortBy('title', 'ASC');
  $categories = $page->children()->visible()->pluck('categories', ',', true);

  return compact(
    'categories',
    'param_category',
    'projects'
  );
};
