import Fullscreen from 'components/fullscreen'
import isMeta from 'utils/is-meta-key'

export default ({
  selector = '[data-fullscreen]',
  container = document.body
} = {}) => {
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

  return {
    destroy: () => {
      fullscreens.forEach(fullscreen => fullscreen.destroy())
      fullscreens = undefined
    }
  }
}
