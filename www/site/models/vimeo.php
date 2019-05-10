<?php

function get_http_response_code ($url) {
  $headers = get_headers($url);
  return substr($headers[0], 9, 3);
}

class VimeoPage extends Page {
  public static function isVimeo () {
    return true;
  }

  public static function isImage () {
    return false;
  }

  public static function getMetadatas ($vimeo_id) {
    $api_endpoint = "https://vimeo.com/api/oembed.json?url=http://vimeo.com/$vimeo_id";

    if (get_http_response_code($api_endpoint) == '404'){
      throw new Exception("Vimeo non trouvée : entrez dans le titre l'identifiant unique de la Vimeo.\nPour \"https://vimeo.com/236552488\", entrez \"236552488\"");
    }

    $response = file_get_contents($api_endpoint);
    return json_decode($response, true);
  }

  public function metadatas ($force = false) {
    if ($force || parent::metadatas()->isEmpty()) {
      $metadatas = VimeoPage::getMetadatas($this->vimeo_id());
      $this->update([
        'metadatas' => Yaml::encode($metadatas)
      ]);
    }

    return parent::metadatas()->yaml();
  }

  public function cover () {
    return $this->image('thumb.jpg');
  }

  public function metadata ($key, $default = null) {
    $metadatas = $this->metadatas();

    return array_key_exists($key, $metadatas)
      ? $metadatas[$key]
      : $default;
  }

  public function src ($options = ['ui' => false, 'autoplay' => true]) {
    $id = $this->vimeo_id();
    $autoplay = $options['autoplay'] ? 'autoplay=1&background=1&loop=1&muted=1&' : '';
    $playback = $this->playback_offset() ? '#t=' . $this->playback_offset() : '';
    return $options['ui']
      ? "https://player.vimeo.com/video/$id?loop=1&color=ffffff&title=0&byline=0&portrait=0"
      : "https://player.vimeo.com/video/$id?controls=0&" . $autoplay . "color=ffffff&title=0&byline=0&portrait=0$playback";
  }

  public function externalUrl ($options = NULL): string {
    return 'https://vimeo.com/' . $this->vimeo_id();
  }

  public function width (): int {
    return $this->metadata('width');
  }

  public function height (): int {
    return $this->metadata('height');
  }

  public function ratio () {
    return $this->width() / $this->height();
  }

  public function duration () {
    return $this->metadata('duration');
  }
}
