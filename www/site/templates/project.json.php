<?php

  header('Content-type: application/json');
  echo json_encode($page->toJSONArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

