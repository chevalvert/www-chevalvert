<?php snippet('html/header') ?>
<?php snippet('barba/header') ?>
<?php snippet('menu') ?>

<?php
  $sectionsInNav = $page->sections()->toBuilderBlocks()->filter(function ($section) {
    return !$section->isMergedWithPrevious()->bool();
  });
?>

<article class="about">
  <nav class="about__sections">
    <ul>
    <?php foreach ($sectionsInNav as $section) : ?>
      <li>
        <a href="#<?= str::slug($section->title()) ?>">
          <?= $section->title()->html() ?>
        </a>
      </li>
    <?php endforeach ?>
    </ul>
  </nav>

  <?php foreach ($page->sections()->toBuilderBlocks() as $section) {
    snippet('about-section--' . $section->_key(), compact('section'));
  } ?>
</article>

<?php snippet('barba/footer') ?>
<?php snippet('footer') ?>
<?php snippet('html/footer') ?>
