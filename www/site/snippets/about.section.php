<section class="about-section">
  <div class="about-section__column">
    <h2>
      <a href="#<?= $section->uid() ?>">
        <?= $section->title()->html() ?>
      </a>
    </h2>
    <div><?= $section->left()->kirbytext() ?></div>
  </div>
  <div class="about-section__column">
    <?= $section->center()->kirbytext() ?>
  </div>
  <div class="about-section__column">
    <?= $section->right()->kirbytext() ?>
  </div>
  <div class="about-section__anchor" id="<?= $section->uid() ?>" ></div>
</section>
