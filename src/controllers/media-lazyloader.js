import 'intersection-observer'
import VimeoPlayer from '@vimeo/player'
import lozad from 'lozad'

export default ({
  selector = '[data-lozad]'
} = {}) => {
  let observer = lozad(selector, {
    rootMargin: '512px 0px',
    threshold: 0.1,
    loaded: el => {
      const src = el.getAttribute('src')
      const isVimeo = src && ~src.indexOf('player.vimeo.com')
      if (!isVimeo) return

      el.removeAttribute('data-loaded')

      const player = new VimeoPlayer(el)
      player.on('play', () => el.setAttribute('data-loaded', true))
    }
  })

  observer.observe()

  return {
    destroy: () => {
      observer = undefined
    }
  }
}
