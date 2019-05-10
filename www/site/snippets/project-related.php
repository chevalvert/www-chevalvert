<ul class="project-related">
  <?php foreach ($project->related()->toPages() as $related) {
    snippet('project-preview', [
      'project' => $related,
      'cover_preset' => 'home'
    ]);
  } ?>
</ul>
