<div class="project-date">
  <time><?= $project->yearBegin()->value() ?></time>

  <?php if ($project->yearEnd()->exists() && $project->yearEnd()->isNotEmpty()) : ?>
  <time><?= $project->yearEnd()->value() ?></time>
  <?php endif ?>
</div>
