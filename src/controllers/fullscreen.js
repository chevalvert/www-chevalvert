import Fullscreen from 'components/fullscreen'
import isMeta from 'utils/is-meta-key'
import isMobile from 'utils/is-mobile'

export default ({
  selector = '[data-fullscreen]',
  container = document.body
} = {}) => {
  if (isMobile()) return

  const elements = document.querySelectorAll(selector)
  if (!elements || !elements.length) return

  let fullscreens = Array.from(elements).map((el, index) => {
    const url = el.getAttribute('data-fullscreen')
    const fullscreen = new Fullscreen(url, {
      container,
      caption: el.getAttribute('data-caption')
    })

    el.addEventListener('click', e => {
      if (isMeta(e)) return
      e.preventDefault()
      fullscreen.open()
    }, false)

    return fullscreen
  })

  fullscreens.forEach((fullscreen, index) => {
    fullscreen.previous = fullscreens[(index + fullscreens.length - 1) % fullscreens.length]
    fullscreen.next = fullscreens[(index + 1) % fullscreens.length]
  })

  window.addEventListener('popstate', handleHistory)
  openFullscreen(window.location.hash.split('#')[1])

  return {
    destroy: () => {
      window.removeEventListener('popstate', handleHistory)
      fullscreens.forEach(fullscreen => fullscreen.destroy())
      fullscreens = undefined
    }
  }

  function handleHistory (e) {
    if (e.state && e.state.isFullscreen) openFullscreen(e.state.id)
  }

  function openFullscreen (id) {
    if (!id) return
    const matchedFullscreen = fullscreens.find(f => f.id === id)
    if (matchedFullscreen) matchedFullscreen.open()
  }
}
