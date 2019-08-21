<header role="banner" class="menu">
  <div class="menu__logo">
    <a href="<?= $site->url() ?>" title="<?= t('go-home') ?>" class="menu__logo-link">
      <?= $site->title()->html() ?>
    </a>
  </div>

  <div class="menu__subtitle" data-alternates="<?= $site->subtitle_alternates() ?>">
    <span><?= $site->subtitle() ?></span>
  </div>

  <nav role="navigation" class="menu__nav">
    <ul>
    <?php foreach ($pages->visible() as $item) : ?>
      <li>
        <a href="<?= $item->url() ?>" class="<?= r($item->isActive(), 'is-active', '') ?>" title="<?= t('go-to') .' '. $item->title() ?>">
          <?= $item->title()->html() ?>
        </a>
      </li>
    <?php endforeach ?>
      <li>
        <?php snippet('menu-language') ?>
      </li>
    </ul>
  </nav>
</header>
