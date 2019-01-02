<meta name="description" content="<?= $site->description()->text() ?>">
<meta name="keywords" content="<?= $site->keywords()->text() ?>">

<link rel="apple-touch-icon" sizes="180x180" href="<?= $kirby->urls()->assets() ?>/favicons/apple-touch-icon.png?v=3">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="icon" type="image/png" sizes="32x32" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-32x32.png?v=3">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-16x16.png?v=3">
<link rel="manifest" href="<?= $kirby->urls()->assets() ?>/favicons/manifest.json?v=3">
<link rel="mask-icon" href="<?= $kirby->urls()->assets() ?>/favicons/safari-pinned-tab.svg?v=3" color="#000000">
<link rel="shortcut icon" href="favicon.ico?v=3">

<meta name="application-name" content="<?= $site->title() ?>">
<meta name="msapplication-TileColor" content="#000000">
<meta name="msapplication-config" content="<?= $kirby->urls()->assets() ?>/favicons/browserconfig.xml">

<meta name="theme-color" content="#000000">

<meta property="og:url" content="<?= $site->url() ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?>">
<meta property="og:description" content="<?= $site->description()->text() ?>">
<meta property="og:site_name" content="<?= $site->title() ?>">
<meta property="og:locale" content="<?= $site->language() ?>">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@<?= $site->twitter()->text() ?>">
<meta name="twitter:creator" content="@<?= $site->twitter()->text() ?>">
<meta name="twitter:url" content="<?= $site->url() ?>">
<meta name="twitter:title" content="<?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?>">
<meta name="twitter:description" content="<?= $site->description()->text() ?>">

<?php
  $image = $page->cover()->isNotEmpty() ? $page->image($page->cover()) : null;

  // NOTE: if on a page without cover, find the first project with a usable cover
  if (!$image) {
    $firstCoveredProject = page('projects')
      ->children()
      ->visible()
      ->filter(function ($p) { return $p->cover()->isNotEmpty(); })
      ->first();
    $image = $firstCoveredProject ? $firstCoveredProject->image($firstCoveredProject->cover()) : null;
  }

  $og_cover = $image ? $image->focusCrop(1200, 630) : null;
  $tw_cover = $image ? $image->focusCrop(280, 150) : null;
?>

<?php if (isset($image)) : ?>
<meta property="og:image" content="<?= $og_cover->url() ?>">
<meta property="og:image:width" content="<?= $og_cover->width() ?>">
<meta property="og:image:height" content="<?= $og_cover->height() ?>">
<meta name="twitter:image" content="<?= $tw_cover->url() ?>">
<?php endif ?>
