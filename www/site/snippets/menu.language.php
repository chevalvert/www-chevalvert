<?php
  // NOTE: this will work only with two languages
  $current_language = $site->language();
  $other_language = '';
  foreach ($site->languages() as $language) {
    if ($language != $current_language) {
      $other_language = $language;
      break;
    }
  }
?>

<a title="<?= l('switch-language', null, $other_language->code()) ?>" href="<?= $page->url($other_language->code()) ?>">
  <?= html($current_language) ?>
</a>
