import html from 'nanohtml'
import isMobile from 'utils/is-mobile'
import Zoom from 'components/zoom'

export default ({
  selector = '[data-zoom]',
  className = 'zoom-media',
  container = document.documentElement,
  stripAttributes = {
    'IMG': ['class', 'width', 'height', 'data-lozad'],
    'IFRAME': ['class']
  }
} = {}) => {
  if (isMobile()) return

  const links = document.querySelectorAll(selector)
  if (!links || !links.length) return

  let zooms = Array.from(links).map(link => {
    const media = link.querySelector('img, iframe')
    if (!media) return

    return new Zoom({
      link,
      container,
      media: clone(media),
      url: link.getAttribute('data-zoom')
    })
  }).map((zoom, index, zooms) => {
    if (!zoom) return
    zoom.previous = zooms[(index + zooms.length - 1) % zooms.length]
    zoom.next = zooms[(index + 1) % zooms.length]

    zoom.link.addEventListener('click', e => {
      if (e.which > 1 || e.shiftKey || e.altKey || e.metaKey || e.ctrlKey) return
      e.preventDefault()
      zoom.open()
    }, false)

    return zoom
  })

  return {
    destroy: () => {
      zooms.forEach(zoom => zoom.destroy())
      zooms = undefined
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

    // Transfer all iframe's classes to its wrapper
    const classes = Array.from(iframe.classList)
    iframe.classList = ''

    return html`
    <div class='${classes}' style='padding-top: ${parseFloat(ratio) * 100}%'>
      ${iframe}
    </div>`
  }
}
