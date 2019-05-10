<?php

  class Contrast {
    static function hexToRgb ($hex) {
      list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
      return [$r, $g, $b];
    }

    static function isHex ($color) {
      return preg_match('/^#[a-f0-9]{6}$/i', $color);
    }

    static function compute ($color) {
      $rgb = Contrast::isHex($color)
        ? Contrast::hexToRgb($color)
        : $color;

      $threshold = 127; // 180

      return (round(((intval($rgb[0]) * 299) + (intval($rgb[1]) * 587) + (intval($rgb[2]) * 114)) / 1000) <= $threshold)
        ? 'dark'
        : 'light';
    }

    static function isLight ($color) {
      return Contrast::compute($color) === 'light';
    }

    static function isDark ($color) {
      return Contrast::compute($color) === 'dark';
    }
  }
