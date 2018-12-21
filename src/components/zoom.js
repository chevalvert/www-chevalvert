import 'nodelist-foreach'
import html from 'nanohtml'

export default class Zoom {
  constructor ({ link, media, container, url, previous, next } = {}) {
    this.link = link
    this.container = container
    this.media = media

    if (url) {
      if (this.media.tagName === 'IMG' || this.media.tagName === 'IFRAME') {
        this.media.setAttribute('src', url)
      } else {
        this.media.querySelectorAll('img, iframe').forEach(el => {
          el.setAttribute('src', url)
        })
      }
    }

    // TODO: add prev/next buttons
    this.element = html`<div class='zoom-container'>${this.media}</div>`
    this.bindFuncs(['interceptClick', 'interceptKey'])
  }

  bindFuncs (funcs) {
    funcs.forEach(func => { this[func] = this[func].bind(this) })
  }

  mount () {
    this.mounted = true
    this.container.append(this.element)
  }

  destroy () {
    this.mounted = false
    this.element.remove()
  }

  bind () {
    window.addEventListener('keyup', this.interceptKey)
    this.element.addEventListener('click', this.interceptClick, false)
  }

  unbind () {
    window.removeEventListener('keyup', this.interceptKey)
    this.element.removeEventListener('click', this.interceptClick)
  }

  interceptClick (e) {
    if (e.which > 1 || e.shiftKey || e.altKey || e.metaKey || e.ctrlKey) return
    e.preventDefault()
    this.close()
  }

  interceptKey (e) {
    if (e.code === 'Escape') this.close()
    if (~['ArrowLeft', 'ArrowUp'].indexOf(e.code)) {
      this.close()
      this.previous.open()
    }
    if (~['ArrowRight', 'ArrowDown'].indexOf(e.code)) {
      this.close()
      this.next.open()
    }
  }

  open () {
    if (!this.mounted) this.mount()
    this.isOpen = true
    this.element.classList.add('is-open')
    this.element.style.display = ''
    this.bind()
    document.body.classList.add('no-scroll')
  }

  close () {
    this.isOpen = false
    this.element.classList.remove('is-open')
    this.element.style.display = 'none'
    this.unbind()
    document.body.classList.remove('no-scroll')
  }
}
