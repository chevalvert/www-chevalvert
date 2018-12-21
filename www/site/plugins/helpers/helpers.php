<?php

  // globally available helpers function
  @include __DIR__ . DS . 'helpers.panel.php';

  function getTopLevelPage ($page) {
    if ($page->depth() === 1) return $page;

    $parents = $page->parents();
    return $parents->last();
  }

  function getMetadata ($id, $lang = null) {
    $site = site();
    $lang = $lang ? $lang : $site->language()->code();
    // SEE: blueprints/taxonomy.word
    if ($lang === $site->defaultLanguage()->code()) $lang = 'title';

    $metadata = page('metadatas')->find($id);
    return $metadata ? $metadata->$lang() : '<a href="'. PanelHelpers::getPanelURL($site->page(), 'edit') .'">UNDEFINED</a>';
  }

  function getCategory ($id, $lang = null) {
    $site = site();
    $lang = $lang ? $lang : $site->language()->code();
    // SEE: blueprints/taxonomy.word
    if ($lang === $site->defaultLanguage()->code()) $lang = 'title';

    $category = page('categories')->find($id);
    return $category ? $category->$lang() : '<a href="'. PanelHelpers::getPanelURL($site->page(), 'edit') .'">UNDEFINED</a>';
  }

  function getVimeoId ($url) {
    if (preg_match('#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m)) {
      return $m[1];
    }
    return false;
  }

  function getVimeoMetas ($id) {
    $metas = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"))[0];
    return $metas;
  }

  function ensureVimeoMeta ($metas, $key, $default) {
    return array_key_exists($key, $metas) ? $metas[$key] : $default;
  }
