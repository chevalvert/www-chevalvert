<!DOCTYPE html>
<html lang="<?= $site->language() ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="cleartype" content="on">

  <script>document.getElementsByTagName('html')[0].className = 'js'</script>

  <?php snippet('header.metas') ?>

  <title><?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?></title>
  <link rel="alternate" type="application/rss+xml" href="<?= url('feed') ?>" title="<?= html($pages->find('feed')->title()) ?>" />

  <?php echo liveCSS('assets/builds/bundle.css') ?>
</head>
<body data-template="<?= $page->intendedTemplate() ?>">
