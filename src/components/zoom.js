import 'nodelist-foreach'

export default class Zoom {
  constructor ({ media, container, url } = {}) {
    this.container = container

    this.element = document.createElement('div')
    this.element.classList.add('zoom-container')

    this.media = media
    if (url) {
      if (media.tagName === 'IMG' || media.tagName === 'IFRAME') {
        media.setAttribute('src', url)
      } else {
        media.querySelectorAll('img, iframe').forEach(el => {
          el.setAttribute('src', url)
        })
      }
    }
    this.element.append(media)

    this.bindFuncs(['interceptClick', 'interceptKey'])
  }

  bindFuncs (funcs) {
    funcs.forEach(func => { this[func] = this[func].bind(this) })
  }

  mount () {
    this.mounted = true
    this.container.append(this.element)

    this.bind()
  }

  destroy () {
    this.mounted = false
    this.element.remove()
    this.unbind()
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
    e.preventDefault()
    this.close()
  }

  interceptKey (e) {
    if (e.code !== 'Escape') return
    this.close()
  }

  open () {
    if (!this.mounted) this.mount()
    this.isOpen = true
    this.element.classList.add('is-open')
    this.element.style.display = ''
  }

  close () {
    this.isOpen = false
    this.element.classList.remove('is-open')
    this.element.style.display = 'none'
  }
}
