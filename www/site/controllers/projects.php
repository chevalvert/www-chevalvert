<?php

return function ($page) {
  $lang = kirby()->language()->code();

  $projects = $page->children()->listed()->filter(function ($p) use ($lang) {
    if (!param('category', false)) return true;
    $found = false;
    foreach ($p->categories()->split() as $category) {
      if (param('category', false) === str::slug(autoid($category)->$lang())) {
        $found = true;
        break;
      };
    }
    return $found;
  });
  $categories = $page->children()->listed()->pluck('categories', ',', true);

  return compact(
    'categories',
    'projects'
  );
};
