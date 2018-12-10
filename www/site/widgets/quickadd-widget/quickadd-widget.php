<?php

  return [
    'title' => [
      'text' => 'Ajout rapide',
      'compressed' => false,
    ],

    'html' => function() {
      return tpl::load(__DIR__ . DS . 'quickadd-widget.html.php');
    }
  ];
