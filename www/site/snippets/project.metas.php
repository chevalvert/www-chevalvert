<?php $lang = $site->language()->code() ?>

<ul class="project-metas">
<?php foreach ($project->metas()->toStructure() as $meta) : ?>
  <li class="project-metas__meta">
    <span class="project-metas__meta-label">
      <?= getMetadata($meta->metadata()) ?>
    </span>
    <span class="project-metas__meta-value">
      <?= r($meta->$lang()->isNotEmpty(), $meta->$lang()->html(), $meta->fr()->html()) ?>
    </span>
  </li>
<?php endforeach ?>
</ul>
