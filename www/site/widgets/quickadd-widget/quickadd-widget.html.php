<?php
  include __DIR__ . DS . 'quickadd-widget.helpers.php';
  $site = site();

  $uris = c::get('widget.quickadd.pageURIs', new Collection());
?>

<div class="dashboard-box">
  <ul class="dashboard-items">
  <?php foreach ($uris as $uri) : ?>
  <?php if ($page = $site->find($uri)) : ?>
    <li class="dashboard-item">
      <a data-modal data-shortcut="+" href="<?= widget\quickadd\getPanelURL($page, 'add') ?>">
        <figure>
          <span class="dashboard-item-icon dashboard-item-icon-with-border"><i class="fa fa-<?= widget\quickadd\getIcon($page, 'plus-circle') ?>"></i></span>
          <figcaption class="dashboard-item-text">
            <?= $page->title() ?>
          </figcaption>
        </figure>
      </a>
    </li>
  <?php endif ?>
  <?php endforeach ?>
  </ul>
</div>

</a>
