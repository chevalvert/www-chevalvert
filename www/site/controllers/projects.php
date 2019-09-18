<?php

return function ($page) {
  $lang = kirby()->language()->code();

  $projects = $page->children()->listed()->filter(function ($p) use ($lang) {
    if (!param('category', false)) return true;
    $found = false;
    foreach ($p->categories()->split() as $category) {
      $id = autoid($category);
      $category = $id ? $id->$lang() : 'undefined';
      if (param('category', false) === str::slug($category)) {
        $found = true;
        break;
      };
    }
    return $found;
  });

  $categories = $page->children()->listed()->pluck('categories', ',', true);
  sort($categories);

  return compact(
    'categories',
    'projects'
  );
};
