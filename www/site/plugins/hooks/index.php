<?php

// SEE: blueprints/pages/vimeo.yml
Kirby::plugin('chevalvert/hooks', [
  'hooks' => [
    'page.create:after' => function ($page) {
      try {
        if ($page->intendedTemplate() != 'vimeo') return;

        $vimeo_id = $page->title();
        $metadatas = VimeoPage::getMetadatas($vimeo_id);
        $title = $metadatas['title'];

        $thumbnail = f::safeName('thumb') . '.jpg';
        $thumbnail_content = file_get_contents($metadatas['thumbnail_url_with_play_button']);
        file_put_contents($page->root() . DS . $thumbnail, $thumbnail_content);

        $page->update(compact('title', 'thumbnail', 'metadatas', 'vimeo_id'));
        $page->changeStatus('unlisted');
      } catch (Exception $e) {
        $page->delete();
        throw $e;
        die();
      }
    }
  ]
]);
