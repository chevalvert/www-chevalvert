<header role="banner" class="menu">
  <div class="menu__logo">
    <a href="<?= $site->url() ?>" title="<?= l('go-home') ?>" class="menu__logo-link">
      <?= $site->title()->html() ?>
    </a>
  </div>

  <div class="menu__subtitle">
    <?= $site->subtitle()->html() ?>
  </div>

  <nav role="navigation" class="menu__nav">
    <ul>
    <?php foreach ($pages->visible() as $item) : ?>
      <li>
        <a href="<?= $item->url() ?>" class="<?= r($item->isActive(), 'is-active', '') ?>" title="<?= l('go-to') .' '. $item->title() ?>">
          <?= $item->title()->html() ?>
        </a>
      </li>
    <?php endforeach ?>
      <li>
        <?php snippet('menu.language') ?>
      </li>
    </ul>
  </nav>


</header>
