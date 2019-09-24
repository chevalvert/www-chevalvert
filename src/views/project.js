import 'nodelist-foreach'
import view from 'abstractions/barba-view'
import fullscreen from 'controllers/fullscreen'
import isMobile from 'utils/is-mobile'
import VimeoPlayer from '@vimeo/player'

export default view('project', {
  onEnterCompleted: refs => {
    const fullscreenSelector = '.project-gallery li [data-fullscreen]'

    if (isMobile()) {
      const fullscreenElements = document.querySelectorAll('.project-gallery li [data-fullscreen]')
      fullscreenElements.forEach(el => {
        el.addEventListener('click', e => {
          // Prevent image to be clicked (this is not desired in mobile)
          e.preventDefault()
          e.stopPropagation()

          // Allow user to click on vimeo to load the iframe inline
          if (el.classList.contains('vimeo')) {
            const src = el.getAttribute('data-fullscreen')
            const iframe = el.querySelector('iframe')
            iframe.setAttribute('src', src)
            iframe.setAttribute('allow', 'autoplay')
            iframe.classList.remove('no-gui')
            el.classList.add('has-user-request-to-play')

            iframe.player = iframe.player || new VimeoPlayer(iframe)
            iframe.player.play()
          }
        })
      })
    } else {
      refs.fullscreen = fullscreen({ selector: fullscreenSelector })
    }
  }
})
