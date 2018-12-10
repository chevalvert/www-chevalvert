<?php

return function ($site, $pages, $page) {
  return [
    'projects' => param('random', false)
      ? page('projects')->children()->visible()->shuffle()->limit(param('random'))
      : page('projects')->pinned()->pages(',')
  ];
};
