import barba from 'controllers/barba'
import lazyloader from 'controllers/media-lazyloader'
import shuffleSubtitle from 'controllers/subtitle-shuffler'

import 'views/about'
import 'views/home'
import 'views/project'
import 'views/projects'

import defaultTransition from 'views/transitions/default'

barba({
  containerClass: 'js-wrapper',

  linkClicked: () => {
    document.body.classList.add('is-loading')
    document.body.removeAttribute('no-scroll')
  },

  newPageReady: lazyloader,

  transitionCompleted: () => {
    document.body.classList.remove('is-loading')
    shuffleSubtitle()
  },

  transitionsMap: {
    default: defaultTransition
  }
})
