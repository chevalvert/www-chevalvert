<?php

Kirby::plugin('arnaudjuracek/kirby-preview-vimeo', [
  'fields' => [
    'vimeo' => [
      'props' => [
        'id' => function (string $id = null) {
          return $id;
        },
      ],
      'computed' => [
        'url' => function () {
          $id = $this->id;
          $playback_offset = $this->playback_offset;
          if ($model = $this->model()) {
            $id = $this->model()->toString($id);
            $playback_offset = $this->model()->toString($playback_offset);
          }

          return "https://player.vimeo.com/video/$id#t=$playback_offset";
        }
      ]
    ]
  ]
]);
