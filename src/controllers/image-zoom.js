import 'nodelist-foreach'
import Zoom from 'components/zoom'

export default ({
  selector = '[data-zoom]',
  className = 'zoom',
  container = document.documentElement,
  stripAttributes = {
    'IMG': ['class', 'width', 'height', 'data-lozad'],
    'IFRAME': ['class']
  }
} = {}) => {
  const links = document.querySelectorAll(selector)
  if (!links || !links.length) return

  links.forEach(link => {
    const media = link.querySelector('img, iframe')
    if (!media) return

    link.zoom = new Zoom({
      container,
      media: clone(media),
      url: link.getAttribute('data-zoom')
    })

    link.addEventListener('click', e => {
      if (e.which > 1 || e.shiftKey || e.altKey || e.metaKey || e.ctrlKey) return
      e.preventDefault()
      link.zoom.open()
    }, false)
  })

  return {
    destroy: () => {
      links.forEach(link => link.zoom.destroy())
    }
  }

  function clone (media) {
    const clone = media.cloneNode()
    stripAttributes[media.tagName].forEach(attr => clone.removeAttribute(attr))

    clone.classList.add(className)

    return media.tagName === 'IFRAME'
      ? conserveIframeRatio(clone)
      : clone
  }

  function conserveIframeRatio (iframe) {
    const ratio = iframe.getAttribute('data-ratio')
    if (!ratio) return

    const wrapper = document.createElement('div')
    wrapper.style.paddingTop = parseFloat(ratio) * 100 + '%'

    wrapper.classList = iframe.classList
    iframe.classList = ''

    wrapper.append(iframe)
    return wrapper
  }
}
