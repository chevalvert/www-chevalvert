import barba from 'controllers/barba'
import lazy from 'controllers/lazy'

import 'views/about'
import 'views/default'
import 'views/project'
import 'views/projects'

import defaultTransition from 'views/transitions/default'

barba({
  containerClass: 'js-wrapper',

  linkClicked: () => document.body.classList.add('is-loading'),
  newPageReady: lazy,
  transitionCompleted: () => document.body.classList.remove('is-loading'),

  transitionsMap: {
    default: defaultTransition
  }
})
