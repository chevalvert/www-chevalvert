<?php $lang = $site->language()->code() ?>

<ul class="project-categories">
<?php foreach ($project->categories()->split() as $category) : ?>
  <li>
    <?= page('categories')->find($category)->$lang()->lower()->html() ?>
  </li>
<?php endforeach ?>
</ul>
