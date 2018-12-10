<?php
  header('Content-type: text/xml; charset="utf-8"');
  echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <?php foreach ($pages->index()->visible() as $p) : ?>
  <?php if (in_array(getTopLevelPage($p)->uri(), c::get('sitemap.ignore'))) continue ?>
  <url>
    <loc><?php echo html($p->url()) ?></loc>
    <lastmod><?php echo $p->modified('%c') ?></lastmod>
    <priority><?php echo ($p->isHomePage()) ? 1 : number_format(0.5/$p->depth(), 1) ?></priority>
  </url>
  <?php endforeach ?>
</urlset>
