<?php

  echo page('projects')
    ->pinned()
    ->pages(',')
    ->feed([
      'title' => $page->title(),
      'description' => $page->text(),
      'link' => '$page->url()'
    ]);
