<?php

  namespace widget\quickadd;
  use yaml;
  use Exception;

  function getPanelURL ($page, $action = 'add') {
    return site()->url() . '/panel/pages/' . $page->uri() . '/' .$action;
  }

  function getBlueprintKey ($blueprint_name, $key, $fallback = false) {
    try {
      $blueprints_dir = kirby()->roots()->blueprints();
      $blueprint_file = $blueprints_dir . DS . $blueprint_name . '.yml';
      $blueprint = yaml::read($blueprint_file);
      return array_key_exists($key, $blueprint)
        ? $blueprint[$key]
        : $fallback;
    } catch (Exception $e) {
      return $fallback;
    }
  }

  function getIcon ($page, $fallback) {
    return getBlueprintKey($page->intendedTemplate(), 'icon', $fallback);
  }
