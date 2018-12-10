<?php

  $kirby = kirby();
  $site = $kirby->site();

  $routes = [];
  foreach ($site->redirections()->toStructure() as $redirection) {
    $routes[] = [
      'pattern' => url::path(rtrim($redirection->from(), '/')) . '(/?)',
      'action' => function () use ($site, $redirection) {
        return header::redirect($site->url() . '/' . $redirection->to(), 308);
      }
    ];
  }

  $kirby->routes($routes);
