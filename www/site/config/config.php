<?php

@include __DIR__ . DS . 'credentials.php';

return [
  'ssl' => true,
  'cache.pages.active' => true,
  'cache.pages.ignore' => function ($page) {
    return $page->no_cache()->bool();
  },

  'sitemap.ignore' => [
    'home',
    'taxonomy',
    'error'
  ],

  'panel.kirbytext' => false,

  'languages' => false,
  'languages.detect' => false,

  'project.media.presets.default' => [
    'quality' => 90,
    'lazyload' => true,
    'allow_fullscreen' => true,
    'autoplay' => true,
  ],

  'project.media.presets.home' => [
    'width' => 1920,
    'srcset' => [1920, 900, 600],
    'ratio' => 16/9,
    'lazyload' => true,
    'allow_fullscreen' => false,
    'autoplay' => true
  ],
  'project.media.presets.projects' => [
    'width' => 600,
    'ratio' => 16/9,
    'crop' => true,
    'lazyload' => true,
    'allow_fullscreen' => false,
    'autoplay' => true
  ],
  'project.media.presets.related' => [
    'width' => 900,
    'srcset' => [900, 600],
    'ratio' => 16/9,
    'crop' => true,
    'lazyload' => true,
    'autoplay' => true
  ],
  'project.media.presets.panel-gallery' => [
    'width' => 600,
    'allow_fullscreen' => false,
    'lazyload' => false,
    'autoplay' => true
  ],

  'project-gallery.layouts.thumbnail_sizes' => [
    '5' => 600,
    '8' => 900,
    '11' => 1280,
    '13' => 1920
  ],

  'routes' => [
    [ // Quick access to the panel from any page by suffixing url with /panel
      'pattern' => '(:all)/panel',
      'action' => function ($path) {
        if (in_array($path, ['fr', 'en'])) return go('panel');

        $path = str_replace(['fr/', 'en/'], '', $path);
        $panel_path = 'pages/' . str_replace('/', '+', $path);
        return site()->user()
          ? go("panel/$panel_path")
          : go("panel/login?_redirect=$panel_path");
      }
    ],
    [ // Redirect */studio#subpage to */studio#anchor
      'pattern' => '(:any)/studio/(:any)',
      'action' => function ($lang, $uid) {
        go(site()->find("studio/$uid") ? "studio#$uid" : 'error');
      }
    ],
    [ // Redirect /random & random/<LENGTH> to the homepage with random projects
      'pattern' => ['(?:(en|fr)/|)?random', '(?:(en|fr)/|)?random/(:num)'],
      'action' => function ($lang, $length = 1) {
        return site()->visit('home', $lang)->render(['random' => $length]);
      }
    ]
  ]
];
