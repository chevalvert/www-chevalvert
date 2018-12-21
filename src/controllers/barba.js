import Barba from 'barba.js'
import ReducerTransition from 'abstractions/barba-transition-reducer'
import noop from 'utils/noop'
import cloneAttributes from 'utils/dom-clone-attributes'

/* global DOMParser */

export default ({
  wrapperId = 'main',
  containerClass = 'wrapper',
  excludedExtensions = /.jpg|.png|.pdf|.jpeg|panel/i,
  transitionsMap = {},
  // SEE http://barbajs.org/events
  linkClicked = noop,
  initStateChange = noop,
  newPageReady = noop,
  transitionCompleted = noop
} = {}) => {
  Barba.Pjax.Dom.wrapperId = wrapperId
  Barba.Pjax.Dom.containerClass = containerClass

  Barba.Dispatcher.on('linkClicked', linkClicked)
  Barba.Dispatcher.on('initStateChange', initStateChange)
  Barba.Dispatcher.on('newPageReady', newPageReady)
  Barba.Dispatcher.on('transitionCompleted', transitionCompleted)

  // SEE: https://github.com/luruke/barba.js/issues/49#issuecomment-237966009
  const parseResponse = Barba.Pjax.Dom.parseResponse
  Barba.Pjax.Dom.parseResponse = function (response) {
    const parser = new DOMParser()
    const html = parser.parseFromString(response, 'text/html')
    cloneAttributes(html.documentElement, document.documentElement)
    cloneAttributes(html.body, document.body)
    return parseResponse.apply(Barba.Pjax.Dom, arguments)
  }

  Barba.Pjax.originalPreventCheck = Barba.Pjax.preventCheck
  Barba.Pjax.preventCheck = (e, el) => {
    if (!Barba.Pjax.originalPreventCheck(e, el)) return false
    if (excludedExtensions.test(el.href.toLowerCase())) return false
    return true
  }

  Barba.Dispatcher.on('linkClicked', el => { Barba.lastClickEl = el })
  Barba.Pjax.getTransition = () => ReducerTransition(transitionsMap)

  Barba.Pjax.init()
  Barba.Prefetch.init()
}
