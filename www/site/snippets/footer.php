<footer class="footer" role="main">
  <div class="footer__column">
    <a href="<?= $site->url() ?>" class="logo">
      <img src="<?= asset('assets/images/logo.svg')->url() ?>">
    </a>
    <div><?= kirbytag('tel') ?></div>
    <div><?= kirbytag('email') ?></div>
  </div>

  <div class="footer__column should-not-break">
    <div><?= kirbytag('facebook') ?></div>
    <div><?= kirbytag('twitter') ?></div>
  </div>

  <div class="footer__column should-not-break">
    <div><?= kirbytag('instagram') ?></div>
    <div><?= kirbytag('vimeo') ?></div>
  </div>

  <div class="footer__column">
    <div><?= kirbytag('github') ?></div>
    <div><?= kirbytag('tooooools') ?></div>
  </div>

  <div class="footer__column">
    <div><a href="<?= page('legals')->url() ?>"><?= page('legals')->title()->html() ?></a></div>
    <div><a href="<?= page('sitemap')->url() ?>"><?= page('sitemap')->title()->html() ?></a></div>
  </div>
</footer>
