<?php

return function ($page) {
  $lang = kirby()->language()->code();

  $hasFilter = param('category', false);
  $projects = $page->children()->listed()->filter(function ($p) use ($lang, $hasFilter) {
    if (!$hasFilter) return true;
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

  if ($hasFilter) $projects = $projects->shuffle();

  $categories = [];

  foreach (page('taxonomy')->categories()->toStructure() as $category) {
    $categories[] = $category->autoid();
  }

  return compact(
    'categories',
    'projects'
  );
};
