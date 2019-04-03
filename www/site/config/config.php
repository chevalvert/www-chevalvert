<?php

@include __DIR__ . DS . 'license.php';
@include __DIR__ . DS . 'credentials.php';

// Core
c::set([
  'cache' => true,
  'cache.ignore' => ['sitemap', 'feed', 'home'],
  'panel.kirbytext' => true,
  'smartypants' => true,
  'markdown.extra' => true
]);

// Medias
c::set([
  'thumbnail.quality' => 90,
  'thumbnail.maxSize' => 1200,
  'ka.image.shrink.maxDimension' => 1920,
  'project-gallery.lineBreakerLayouts' => [1, 4, 5]
]);

// Routing
c::set([
  'ssl' => true,
  'sitemap.ignore' => [
    'home',
    'feed',
    'sitemap',
    'categories',
    'metadatas',
    'error',
    'backups'
  ],

  'routes' => [
    // NOTE: quick access to the panel from any page
    [
      'pattern' => '(?:en/|)(:all)/panel',
      'action' => function ($path) {
        $panel_path = $path === 'en' ? "" : "pages/$path/edit";
        return site()->user()
          ? go("panel/$panel_path")
          : go("panel/login?_redirect=$panel_path");
      }
    ],
    // SEE: https://github.com/arnaudjuracek/kirby-backup-widget#security
    [
      'pattern' => 'content/backups/(:any)',
      'action' => function ($file) {
        if (site()->user()) {
          // NOTE: only logged users have access to content/backups files
          page('backups')->files()->find($file)->download();
        } else {
          header::forbidden();
          die('Unauthorized access');
        }
      }
    ],
    // NOTE: redirect studio#subpage to studio#anchor
    [
      'pattern' => 'studio/(:any)',
      'action' => function ($anchor) {
        go(site()->find("studio/$anchor") ? "studio#$anchor" : 'error');
      }
    ],
    // NOTE: redirect /random & random/<LENGTH> to the homepage with random projects
    [
      'pattern' => 'random',
      'action' => function () {
        return ['home', ['random' => true]];
      }
    ],
    [
      'pattern' => 'random/(:num)',
      'action' => function ($length) {
        return ['home', ['random' => $length]];
      }
    ]
  ]
]);

// Localization
c::set([
  'date.handler' => 'strftime',
  'date.format' => '%e %B %Y',
  'language.detect' => false,
  'languages' => [
    [
      'code' => 'fr',
      'name' => 'French',
      'default' => true,
      'url' => '/',
      'locale'  =>  'fr_FR.UTF-8'
    ],
    [
      'code' => 'en',
      'name' => 'English',
      'url' => 'en',
      'locale' => 'en_US.UTF-8'
    ]
  ],

  'typography.wordspacing.singlecharacter' => false,
  'typography.punctuation.spacing.english' => true,
  'typography.dashes.style' => 'em',
  'typography.quotes.primary' => 'doubleGuillemetsFrench',
  'typography.quotes.secondary' => 'doubleCurled',
  'typography.hyphenation.language' => 'fr',
  'typography.hyphenation.minlength' => 12,
  'typography.hyphenation.titlecase' => false,
  'typography.hyphenation.allcaps' => false,
  'typography.hyphenation.compounds' => false,
  'typography.math' => false,
  'typography.fractions' => false,
  'typography.dewidow' => false,

  'translations.translation' => [
    'en' => [
      'lbl_is_up_to_date' => 'Translation is up to date',
      'btn_cancel' => 'Annuler',
      'btn_delete' => 'Supprimer',
      'alert_update' => 'Cette action remettra à zéro le fichier. Tout changement sera perdu.',
      'sync' => 'Synchroniser',
      'with' => 'avec',
    ]
  ],
]);

// Panel
c::set([
  'panel.widgets' => [
    'quickadd-widget' => true,
    'pages'    => true,
    'account'  => true,
    'history'  => true,
    'site'     => true,
    'kirby-backup-widget' => true,
    'typography' => false,
  ],

  'focus.field.fullwidth' => true,
  'widget.backup.include_site' => true,
  'widget.quickadd.pageURIs' => [
    'projects'
  ]
]);

// Set session validity to 30 days
// SEE: https://forum.getkirby.com/t/login-session-lifetime-extending-for-the-frontend/2922/3
// SEE: https://github.com/jenstornell/kirby-secrets/wiki/Fingerprint
c::set([
  'panel.session.timeout' => 60 * 24 * 30,
  'panel.session.lifetime' => 60 * 24 * 30
]);
s::$timeout =  60 * 24 * 30;
s::$cookie['lifetime'] = 0;
s::$fingerprint = function () { return sha1(Visitor::ua()); };
