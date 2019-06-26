<section class="about-section about-section--list <?= r($section->isMergedWithPrevious()->bool(), 'is-merged-with-previous-section') ?> <?= r($section->noCSSCol()->bool(), 'force-one-column') ?>">
  <div class="about-section__anchor" id="<?= str::slug($section->title()) ?>"></div>

  <div class="about-section__row">
    <div class="about-section__column">
      <?= r($section->isMergedWithPrevious()->bool(), '<h3>', '<h2>') ?>
        <?= $section->title()->html() ?>
      <?= r($section->isMergedWithPrevious()->bool(), '</h3>', '</h2>') ?>
    </div>

    <div class="about-section__column">
      <?= $section->list()->kt()  ?>
    </div>
  </div>
</section>
