<?php

  namespace widget\quickadd;

  function getPanelURL ($page, $action = 'add') {
    return site()->url() . '/panel/pages/' . $page->uri() . '/' .$action;
  }
