<?php

  // globally available helpers function
  @include __DIR__ . DS . 'helpers.panel.php';

  function getTopLevelPage ($page) {
    if ($page->depth() === 1) return $page;

    $parents = $page->parents();
    return $parents->last();
  }

  function getMetadata ($id, $lang = null) {
    $lang = $lang ? $lang : site()->language()->code();
    return page('metadatas')->find($id)->$lang();
  }

  function getCategory ($id, $lang = null) {
    $lang = $lang ? $lang : site()->language()->code();
    return page('categories')->find($id)->$lang();
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
