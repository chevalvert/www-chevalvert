<?php

class PanelHelpers {
  // NOTE: this is used in projects.yml by the index field
  static function parseProjects ($pages) {
    $categories = page('categories')->children();

    foreach ($pages as &$page) {
      $p = page($page['uri']);

      $page['parsedPosition'] = '<p style="text-align:center">' . r($p->num(), $p->num(), '-') . '</p>';
      $page['parsedTitle'] = '<b>' . $p->title()->html() . '</b>';
      $page['parsedYear'] = $p->yearBegin()->value() . r($p->yearEnd()->isNotEmpty(), '-' . $p->yearEnd()->value());
      $page['parsedCategories'] = join(' / ', $p->categories()->split());
    }
    return $pages;
  }

  static function getPanelURL ($page, $action = 'add') {
    return site()->url() . '/panel/pages/' . $page->uri() . '/' .$action;
  }
}
