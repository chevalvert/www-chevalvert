<?php

return function ($site, $pages, $page, $options) {
  return [
    'projects' => array_key_exists('random', $options)
      ? page('projects')
        ->children()
        ->visible()
        ->shuffle()
        // NOTE: if 'random' => true, do not limit the projects collection
        ->limit($options['random'] === true ? null : $options['random'])
      : page('projects')->pinned()->pages(',')
  ];
};
