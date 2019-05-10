<section class="about-section about-section--grid <?= r($section->isMergedWithPrevious()->bool(), 'is-merged-with-previous-section') ?>">
  <div class="about-section__anchor" id="<?= str::slug($section->title()) ?>"></div>

  <div class="about-section__row">
    <div class="about-section__column">
      <?= r($section->isMergedWithPrevious()->bool(), '<h3>', '<h2>') ?>
        <?= $section->title()->html() ?>
      <?= r($section->isMergedWithPrevious()->bool(), '</h3>', '</h2>') ?>
    </div>

    <div class="about-section__column">
      <ul class="about-section--grid__items">
        <?php foreach ($section->items()->toBuilderBlocks() as $item) : ?>
        <li class="about-section--grid__item">
          <?= $item->text()->kt()  ?>
        </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</section>
