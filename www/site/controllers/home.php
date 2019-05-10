<?php

return function ($page, $random = false) {
  return [
    'projects' => $random
      ? page('projects')->children()->listed()->shuffle()->limit($random)
      : site()->pinned()->toPages()->shuffle()
  ];
};
