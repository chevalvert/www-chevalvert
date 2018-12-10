<?php snippet('site.header') ?>
<?php snippet('barba.header') ?>
<?php snippet('menu') ?>

<nav class="about__sections">
  <ul>
  <?php foreach ($page->anchors()->pages(',') as $anchor) : ?>
    <li>
      <a href="#<?= $anchor->uid() ?>">
        <?= $anchor->title()->html() ?>
      </a>
    </li>
  <?php endforeach ?>
  </ul>
</nav>

<?php foreach ($page->children()->visible() as $section) {
  snippet('about.section', compact('section'));
} ?>

<?php snippet('barba.footer') ?>
<?php snippet('site.footer') ?>
