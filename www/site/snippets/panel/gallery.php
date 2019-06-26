<section class="panel-gallery">
  <ul class="panel-gallery__medias" data-ratio="<?= $data->ratio() ?>">
    <li class="panel-gallery__media">
      <?php if ($data->media_1()->isNotEmpty()) : ?>
        <?php $page->media($data->media_1(), 'panel-gallery') ?>
      <?php endif ?>
    </li>

    <li class="panel-gallery__media">
      <?php if ($data->media_2()->isNotEmpty()) : ?>
        <?php $page->media($data->media_2(), 'panel-gallery') ?>
      <?php endif ?>
    </li>

    <li class="panel-gallery__media">
      <?php if ($data->media_3()->isNotEmpty()) : ?>
        <?php $page->media($data->media_3(), 'panel-gallery') ?>
      <?php endif ?>
    </li>
  </ul>
</section>
