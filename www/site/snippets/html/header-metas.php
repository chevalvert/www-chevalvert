<meta name="description" content="<?= $site->description()->text() ?>">
<meta name="keywords" content="<?= $site->keywords()->text() ?>">

<link rel="apple-touch-icon" sizes="180x180" href="<?= $kirby->urls()->assets() ?>/favicons/apple-touch-icon.png?v=3">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="icon" type="image/png" sizes="32x32" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-32x32.png?v=3">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-16x16.png?v=3">
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
  $cover = $page->cover(null, true);

  // On a page with a Vimeo cover, try to fallback to the first image
  if ($cover->isVimeo()) $cover = $page->images()->first();

  // On a page without cover, randomly find a project with a usable cover
  if (!$cover) {
    $firstCoveredProject = $site->pinned()
      ->toPages()
      ->filter(function ($p) { return $p->cover(null, true)->isVimeo() !== true; })
      ->shuffle()
      ->first();

    if ($firstCoveredProject) $cover = $firstCoveredProject->cover(null, true);
  }
?>

<?php if (isset($cover) && $cover) : ?>
<?php
  $og_cover = $cover->thumb(['width' => 1200, 'height' => 630, 'crop' => true]);
  $tw_cover = $cover->thumb(['width' => 280, 'height' => 150, 'crop' => true]);
?>
<meta property="og:image" content="<?= $og_cover->url() ?>">
<meta property="og:image:width" content="<?= $og_cover->width() ?>">
<meta property="og:image:height" content="<?= $og_cover->height() ?>">
<meta name="twitter:image" content="<?= $tw_cover->url() ?>">
<?php endif ?>
