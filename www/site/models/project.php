<?php

class ProjectPage extends Page {
  public function vimeos () {
    return $this->children()->unlisted()->filter(function ($p) {
      return $p->isVimeo();
    });
  }

  public function medias () {
    return array_merge($this->images()->values(), $this->vimeos()->values());
  }

  public function cover ($options = [], $return = false) {
    $rawCover = $this->cover_raw();
    if ($rawCover->isEmpty()) return;

    return $this->media($rawCover, $options, $return);
  }

  public function panelPreviewCover () {
    $vimeo = page($this->cover_raw());

    return ($vimeo && $vimeo->isVimeo())
      ? $vimeo->cover()
      : image($this->cover_raw());
  }

  public function media ($media, $options = [], $return = false) {
    if (!$media) return;

    if (empty($options)) {
      $options = option('project.media.presets.default');
    } elseif (is_string($options)) {
      $options = option('project.media.presets.' . $options);
    } else {
      $options = array_merge(option('project.media.presets.default'), $options);
    }

    $vimeo = page($media);

    if ($vimeo && $vimeo->isVimeo()) {
      if ($return) return $vimeo;
      snippet('vimeo', array_merge(compact('vimeo'), $options));
    } else {
      $image = image($media);
      if ($return) return $image;
      snippet('image', array_merge(compact('image'), $options));
    }
  }
}
