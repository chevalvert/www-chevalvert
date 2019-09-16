<?php

namespace socialKirbytags;

$aliases = [
  'tel' => [
    'html' => function ($tag) {
      return '<a href="tel:'. site()->phone()->value() .'">'. html(site()->phone()) .'</a>';
    }
  ],
  'email' => [
    'html' => function ($tag) {
      return '<a href="mailto:'. site()->email()->value() .'">'. html(site()->email()) .'</a>';
    }
  ]
];

use Kirby;
Kirby::plugin('chevalvert/social-kirbytags', [
  'tags' => [
    'facebook' => createSocialTag('facebook', 'https://facebook.com'),
    'twitter' => createSocialTag('twitter', 'https://twitter.com'),
    'instagram' => createSocialTag('instagram', 'https://instagram.com'),
    'vimeo' => createSocialTag('vimeo', 'https://vimeo.com'),
    'github' => createSocialTag('github', 'https://github.com'),

    'tooooools' => [
      'html' => function ($tag) {
        return '<a href="'. site()->tooooools()->value() .'">tooooools</a>';
      }
    ],

    'tel' => $aliases['tel'],
    'telephone' => $aliases['tel'],
    'phone' => $aliases['tel'],

    'email' => $aliases['email'],
    'mail' => $aliases['email'],
    'e-mail' => $aliases['email']
  ]
]);

function createSocialTag ($name, $url) {
  return [
    'html' => function ($tag) use ($name, $url) {
      $id = site()->$name();
      $text = $tag->$name() ? $tag->$name() : $name;
      return "<a href='$url/$id' target='_blank' rel='noopener'>$text</a>";
    }
  ];
}
