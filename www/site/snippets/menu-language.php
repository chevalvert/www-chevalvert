<?php
  // NOTE: this will work only with two languages
  $current_language = $kirby->language();
  $other_language = '';
  foreach ($kirby->languages() as $language) {
    if ($language != $current_language) {
      $other_language = $language;
      break;
    }
  }
?>

<a data-lang-switcher title="<?= t('switch-language', null, $other_language->code()) ?>" href="<?= $page->url($other_language->code()) ?>">
  <?= html($other_language) ?>
</a>
