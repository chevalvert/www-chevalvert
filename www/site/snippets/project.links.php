<?php $lang = $site->language()->code() ?>

<ul class="project-links">
<?php foreach ($project->links()->toStructure() as $link) : ?>
  <li class="project-links__link">
    <a href="<?= $link->url() ?>">
      <?= r($link->$lang()->isNotEmpty(), $link->$lang()->html(), $link->fr()->html()) ?>
    </a>
  </li>
<?php endforeach ?>
</ul>
