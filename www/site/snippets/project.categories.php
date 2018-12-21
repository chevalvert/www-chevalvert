<ul class="project-categories">
<?php foreach ($project->categories()->split() as $category) : ?>
  <li>
    <?= html(str::lower(getCategory($category))) ?>
  </li>
<?php endforeach ?>
</ul>
