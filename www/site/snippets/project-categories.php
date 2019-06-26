<?php
  $lang = $kirby->language()->code();
  $linkable = isset($linkable) && $linkable;
?>

<ul class="project-categories">
<?php foreach ($project->categories()->split() as $category) : ?>
  <li>
    <?php snippet('category', compact('category', 'linkable')) ?>
  </li>
<?php endforeach ?>
</ul>
