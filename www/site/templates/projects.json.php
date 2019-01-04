<?php

  header('Content-type: application/json');

  $projectsArray = [];
  foreach ($projects as $project) {
    $projectsArray[] = $project->toJSONArray();
  }

  echo json_encode($projectsArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
