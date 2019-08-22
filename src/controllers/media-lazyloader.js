import 'intersection-observer'
import 'nodelist-foreach'
import VimeoPlayer from '@vimeo/player'
import lozad from 'lozad'

export default ({
  selector = '[data-lozad]'
} = {}) => {
  let observer = lozad(selector, {
    rootMargin: '512px 0px',
    threshold: 0.1,
    loaded: el => isVimeo(el) && setLoadedAttributeOnPlay(el)
  })

  // NOTE: as loading Vimeo can take some time, it is better for the user
  // perception to load them as soon as possible: the lazyloading in this case
  // is only used to get the [data-loaded=true] attribute to fade the iframe
  // when playing begins.
  const vimeos = document.querySelectorAll('iframe[data-src*="vimeo"]')
  vimeos.forEach(vimeo => observer.triggerLoad(vimeo))

  observer.observe()

  return {
    destroy: () => {
      observer = undefined
    }
  }

  function isVimeo (el) {
    const src = el.getAttribute('src')
    return src && ~src.indexOf('player.vimeo.com')
  }

  function setLoadedAttributeOnPlay (vimeoEl) {
    vimeoEl.removeAttribute('data-loaded')

    vimeoEl.player = new VimeoPlayer(vimeoEl)
    vimeoEl.player.on('play', () => vimeoEl.setAttribute('data-loaded', true))
  }
}
