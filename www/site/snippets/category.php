<?php
  $lang = $kirby->language()->code();

  $category = autoid($category)->$lang();
  $linkable = isset($linkable) && $linkable;

  $slug = str::slug($category);


  $class = r($slug === param('category'), 'is-active');
  $url = url($site->page('projects')->url(), ['params' => ['category' => $slug]]);

  if ($linkable) echo "<a class='$class' href='$url'>";
  echo $category;
  if ($linkable) echo "</a>";
?>
