<section class="about-section about-section--basic <?= r($section->isMergedWithPrevious()->bool(), 'is-merged-with-previous-section') ?>">
  <div class="about-section__anchor" id="<?= str::slug($section->title()) ?>"></div>

  <div class="about-section__row">
    <div class="about-section__column">
      <?= r($section->isMergedWithPrevious()->bool(), '<h3>', '<h2>') ?>
        <?= $section->title()->html() ?>
      <?= r($section->isMergedWithPrevious()->bool(), '</h3>', '</h2>') ?>
      <div><?= $section->left()->kt() ?></div>
    </div>

    <div class="about-section__column about-section__content">
      <?= $section->center()->kt() ?>
    </div>

    <div class="about-section__column">
      <?= $section->right()->kt() ?>
    </div>
  </div>
</section>
