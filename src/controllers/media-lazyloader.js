import 'intersection-observer'
import 'nodelist-foreach'
import VimeoPlayer from '@vimeo/player'
import isMobile from 'utils/is-mobile'
import lozad from 'lozad'

export default ({
  selector = '[data-lozad]'
} = {}) => {
  let observer = lozad(selector, {
    rootMargin: '512px 0px',
    threshold: 0.1,
    load: el => {
      // Do not lazyload vimeo on mobile
      if (isMobile() && willBeVimeo(el)) return

      el.src = el.getAttribute('data-src')
    },
    loaded: el => {
      if (isMobile()) return
      if (!isVimeo(el)) return
      setLoadedAttributeOnPlay(el)
      autoLoop(el)
    }
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

  function willBeVimeo (el) {
    const datasrc = el.getAttribute('data-src')
    return datasrc && ~datasrc.indexOf('player.vimeo.com')
  }

  function isVimeo (el) {
    const src = el.getAttribute('src')
    return src && ~src.indexOf('player.vimeo.com')
  }

  function setLoadedAttributeOnPlay (el) {
    el.player = el.player || new VimeoPlayer(el)

    el.removeAttribute('data-loaded')
    el.player.on('play', () => el.setAttribute('data-loaded', true))
  }

  async function autoLoop (el) {
    el.player = el.player || new VimeoPlayer(el)

    // Fail if this player has already been autoLooped
    if (el.player.autoLooped) return
    el.player.autoLooped = true

    // Fail if no loop is needed for this vimeo
    if (!await el.player.getLoop()) return

    const offset = el.getAttribute('src')
      .split('#').pop()
      .split('&').map(str => +str.split('=').pop())

    offset[0] = (isNaN(offset[0]) || !offset[0]) ? 0 : offset[0]
    offset[1] = (isNaN(offset[1]) || !offset[1]) ? await el.player.getDuration() : offset[1]

    el.player.on('timeupdate', ({ seconds }) => {
      if (seconds < offset[0] || seconds > offset[1]) {
        el.player.setCurrentTime(offset[0])
      }
    })
  }
}
