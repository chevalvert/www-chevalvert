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
    this.interceptHistory = this.interceptHistory.bind(this)
    this.interceptClick = this.interceptClick.bind(this)
    this.goToPrevious = this.goToPrevious.bind(this)
    this.goToNext = this.goToNext.bind(this)
    this.close = this.close.bind(this)
  }

  render () {
    this.media = !this.isVimeo
      ? html`<img src='${this.url}'>`
      : html`<div style='padding-top:56.25%'>
        <iframe src='${this.url}' allow='autoplay' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen>
      </div>`

    this.buttons = {
      previous: html`<button type='button'>${raw('&larr;')}</button>`,
      next: html`<button type='button'>${raw('&rarr;')}</button>`,
      close: html`<button type='button'>${raw('&harr;')}</button>`
    }

    return html`
    <div class='fullscreen'>
      <div class='fullscreen__media ${this.isVimeo ? 'is-vimeo' : ''}'>
        ${this.media}
      </div>
      <footer class='fullscreen__footer'>
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

  get id () {
    return this.isVimeo
      ? parseInt(this.url.split('/').pop()).toString()
      : this.url.split('/').pop()
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
    window.addEventListener('popstate', this.interceptHistory)
    this.element.addEventListener('click', this.interceptClick, false)
    this.buttons.previous.addEventListener('click', this.goToPrevious)
    this.buttons.next.addEventListener('click', this.goToNext)
    this.buttons.close.addEventListener('click', this.close)

    swipeListener(this.element, e => {
      if (e.srcElement && !e.srcElement.classList.contains('fullscreen__media')) return

      if (e.delta[0] < 0) this.goToPrevious({ transition: 'from-left' })
      if (e.delta[0] > 0) this.goToNext({ transition: 'from-right' })
    })
  }

  unbind () {
    window.removeEventListener('keyup', this.interceptKey)
    window.removeEventListener('popstate', this.interceptHistory)
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
    if (~['ArrowLeft', 'ArrowUp'].indexOf(e.code)) this.goToPrevious()
    if (~['ArrowRight', 'ArrowDown'].indexOf(e.code)) this.goToNext()
  }

  interceptHistory (e) {
    this.close()
  }

  get inHistory () {
    return window.history.state && window.history.state.isFullscreen
  }

  pushToHistory () {
    const state = { isFullscreen: true, id: this.id }

    const action = this.inHistory ? 'replaceState' : 'pushState'
    window.history[action](state, document.title, '#' + this.id)
  }

  cleanHistory () {
    if (this.inHistory) window.history.back()
  }

  open ({ transition = null } = {}) {
    if (this.isOpen) return
    if (!this.mounted) this.mount()

    this.bind()
    this.pushToHistory()
    this.preloadNeighbors()

    this.isOpen = true
    this.element.setAttribute('data-transition', transition || '')
    this.element.classList.add('is-open')
    this.element.style.display = ''
    this.activateMedia()

    document.body.setAttribute('no-scroll', '')
  }

  activateMedia () {
    if (this.player) {
      this.player
        .play()
        .then(() => this.media.setAttribute('data-loaded', true))
        .catch(err => {
          console.warn(err)
          this.media.setAttribute('data-loaded', true)
        })
      return
    }

    if (this.media.complete) this.media.setAttribute('data-loaded', true)
    this.media.onload = () => this.media.setAttribute('data-loaded', true)
  }

  close ({ cleanHistory = true } = {}) {
    this.unbind()

    this.isOpen = false
    this.element.classList.remove('is-open')
    this.element.removeAttribute('data-transition')
    this.element.style.display = 'none'

    if (this.player) this.player.pause()
    if (cleanHistory) this.cleanHistory()

    document.body.removeAttribute('no-scroll')
  }

  goToPrevious ({ transition = null } = {}) {
    this.close({ cleanHistory: false })
    this.previous.open({ transition })
  }

  goToNext ({ transition = null } = {}) {
    this.close({ cleanHistory: false })
    this.next.open({ transition })
  }

  static get PRELOAD_DELAY () { return 300 }

  get preloaded () { return this.mounted }

  preload () {
    if (this.preloaded) return

    this.mount()
    this.close({ cleanHistory: false })
  }

  preloadNeighbors () {
    clearTimeout(this.preloader)
    this.preloader = setTimeout(() => {
      this.previous.preload()
      this.next.preload()
    }, Fullscreen.PRELOAD_DELAY)
  }
}
