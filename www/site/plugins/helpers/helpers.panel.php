<?php

class PanelHelpers {
  // NOTE: this is used in projects.yml by the index field
  static function parseProjects ($pages) {
    $categories = page('categories')->children();

    foreach ($pages as &$page) {
      $p = page($page['uri']);

      $page['parsedTitle'] = '<b>' . $p->title()->html() . '</b>';
      $page['parsedYear'] = $p->yearBegin()->value() . r($p->yearEnd()->isNotEmpty(), '-' . $p->yearEnd()->value());
      $page['parsedCategories'] = join(' / ', $p->categories()->split());

      $page['position'] = '
        <a data-modal style="display:block; text-align:center" title="Changer de position" class="btn btn-with-icon" href="' . self::getPanelURL($p, 'toggle?_redirect=pages/' . $p->parent() . '/edit') . '">
          ' . r($p->num(), $p->num(), '-') . '
        </a>';

      $page['preview'] = '
        <a target="_blank" title="Prévisualiser" class="btn btn-with-icon" href="' . url($p->url()) . '">
          <i class="icon fa fa-play-circle-o"></i>
        </a>';

      $page['visible'] = '
        <a data-modal title="'. r($p->isVisible(), 'Rendre invisible', 'Rendre visible') .'" class="btn btn-with-icon" href="' . self::getPanelURL($p, 'toggle?_redirect=pages/' . $p->parent() . '/edit') . '">
          <i class="icon fa fa-eye'. r($p->isInvisible(), '-slash') . '"></i>
        </a>';

      $page['trash'] = '
        <a data-modal title="Supprimer" class="btn btn-with-icon" href="' . self::getPanelURL($p, 'delete?_redirect=pages/' . $p->parent() . '/edit') . '">
          <i class="icon fa fa-trash-o"></i>
        </a>';
    }
    return $pages;
  }

  static function getPanelURL ($page, $action = 'add') {
    return site()->url() . '/panel/pages/' . $page->uri() . '/' .$action;
  }
}
