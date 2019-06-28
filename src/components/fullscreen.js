import html from 'nanohtml'
import raw from 'nanohtml/raw'
import VimeoPlayer from '@vimeo/player'
import isMeta from 'utils/is-meta-key'
import swipeListener from 'utils/swipe-listener'

export default class Fullscreen {
  constructor (url, {
    container = document.body,
    caption = ''
  } = {}) {
    this.url = url
    this.container = container
    this.caption = caption

    this.interceptKey = this.interceptKey.bind(this)
    this.interceptClick = this.interceptClick.bind(this)
    this.goToPrevious = this.goToPrevious.bind(this)
    this.goToNext = this.goToNext.bind(this)
    this.close = this.close.bind(this)
  }

  render () {
    this.media = !this.isVimeo
      ? html`<img src='${this.url}'>`
      : html`<div style='padding-top:56.25%'>
        <iframe src='${this.url}' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen>
      </div>`

    this.buttons = {
      previous: html`<button type='button'>${raw('&lt;')}</button>`,
      next: html`<button type='button'>${raw('&gt;')}</button>`,
      close: html`<button type='button'>x</button>`
    }

    return html`
    <div class='fullscreen'>
      <div class='fullscreen__media ${this.isVimeo ? 'is-vimeo' : ''}'>
        ${this.media}
      </div>
      <footer class="fullscreen__footer">
        <div class='fullscreen__caption'>
          ${this.caption}
        </div>
        <div class='fullscreen__toolbar'>
          ${Object.values(this.buttons)}
        </div>
      </footer>
    </div>`
  }

  get isVimeo () {
    return ~this.url.indexOf('player.vimeo.com')
  }

  mount () {
    if (this.mounted) return

    this.mounted = true
    this.element = this.render()
    this.container.append(this.element)

    if (this.isVimeo) this.player = new VimeoPlayer(this.media)
  }

  destroy () {
    if (!this.mounted) return

    this.mounted = false
    if (this.player) this.player.destroy()
    this.element.remove()
  }

  bind () {
    window.addEventListener('keyup', this.interceptKey)
    this.element.addEventListener('click', this.interceptClick, false)
    this.buttons.previous.addEventListener('click', this.goToPrevious)
    this.buttons.next.addEventListener('click', this.goToNext)
    this.buttons.close.addEventListener('click', this.close)

    swipeListener(this.element, e => {
      if (e.srcElement && !e.srcElement.classList.contains('fullscreen__media')) return

      if (e.delta[0] < 0) this.goToPrevious()
      if (e.delta[0] > 0) this.goToNext()
    })
  }

  unbind () {
    window.removeEventListener('keyup', this.interceptKey)
    this.element.removeEventListener('click', this.interceptClick)
    this.buttons.previous.removeEventListener('click', this.goToPrevious)
    this.buttons.next.removeEventListener('click', this.goToNext)
    this.buttons.close.removeEventListener('click', this.close)
  }

  interceptClick (e) {
    if (isMeta(e)) return
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
    if (this.isOpen) return
    if (!this.mounted) this.mount()

    this.bind()

    this.isOpen = true
    this.element.classList.add('is-open')
    this.element.style.display = ''

    if (this.player) this.player.play()

    document.body.setAttribute('no-scroll', '')
  }

  close () {
    this.unbind()

    this.isOpen = false
    this.element.classList.remove('is-open')
    this.element.style.display = 'none'

    if (this.player) this.player.pause()

    document.body.removeAttribute('no-scroll')
  }

  goToPrevious () {
    this.close()
    this.previous.open()
  }

  goToNext () {
    this.close()
    this.next.open()
  }
}
