<?php

class ProjectPage extends Page {
  public function toJSONArray () {
    $site = site();
    $JSON_ARRAY = json_decode($this->toJson());

    $JSON_ARRAY->content = [];
    foreach ($site->languages() as $code => $lang) {
      $JSON_ARRAY->content[$code] = $this->content($code)->toArray();

      $JSON_ARRAY->content[$code]['links'] = [];
      foreach ($this->links()->toStructure() as $link) {
        $JSON_ARRAY->content[$code]['links'][] = [
          'url' => (string) $link->url(),
          'value' => (string) $link->$code()
        ];
      }

      $JSON_ARRAY->content[$code]['gallery'] = [];
      foreach ($this->gallery()->toStructure() as $media) {
        $JSON_ARRAY->content[$code]['gallery'][] = [
          'layout' => (string) $media->layout(),
          'image' => $media->image()->isNotEmpty() ? [
            'url' => (string) $media->image()
          ] : null,
          'vimeo' => $media->vimeo()->isNotEmpty() ? [
            'url' => (string) $media->vimeo(),
            'playbackOffset' => $media->playback_offset()->int()
          ] : null,
        ];
      }

      $JSON_ARRAY->content[$code]['metas'] = [];
      foreach ($this->metas()->toStructure() as $meta) {
        $JSON_ARRAY->content[$code]['metas'] = [
          'label' => (string) $meta->metadata(),
          'value' => (string) $meta->$code()
        ];
      }
    }

    return $JSON_ARRAY;
  }
}
