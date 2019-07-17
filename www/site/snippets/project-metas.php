<?php $lang = $kirby->language()->code() ?>

<?php if ($project->metas()->isNotEmpty()) : ?>
<ul class="project-metas">
<?php foreach ($project->metas()->toStructure() as $meta) : ?>
  <?php $label = autoid($meta->meta()) ?>
  <li class="project-metas__meta">

    <?php if ($label) : ?>
    <span class="project-metas__meta-label"><?= $label->$lang() ?></span>
    <?php endif ?>

    <span class="project-metas__meta-value">
      <?= r($meta->$lang()->isNotEmpty(), $meta->$lang()->html(), $meta->fr()->html()) ?>
    </span>
  </li>
<?php endforeach ?>
</ul>
<?php endif ?>
