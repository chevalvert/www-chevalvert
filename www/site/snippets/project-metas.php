<?php $lang = $kirby->language()->code() ?>
<?php if ($project->metas()->isNotEmpty()) : ?>
<ul class="project-metas">
<?php foreach ($project->metas()->toStructure() as $meta) : ?>
  <li class="project-metas__meta">
    <span class="project-metas__meta-label"><?= autoid($meta->meta())->$lang() ?></span>
    <span class="project-metas__meta-value">
      <?= r($meta->$lang()->isNotEmpty(), $meta->$lang()->html(), $meta->fr()->html()) ?>
    </span>
  </li>
<?php endforeach ?>
</ul>
<?php endif ?>
