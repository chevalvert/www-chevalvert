import 'nodelist-foreach'
import view from 'abstractions/barba-view'
import isMobile from 'utils/is-mobile'

export default view('home', {
  onEnterCompleted: refs => {
    if (isMobile()) return

    const previews = document.querySelectorAll('.project-preview')

    previews.forEach((preview, index) => {
      const next = previews[index + 1]
      if (!next) return

      preview.above = preview.querySelector('.project-preview__header')
      preview.below = next.querySelector('.project-preview__header').cloneNode(true)

      preview.above.parentNode.insertBefore(preview.below, preview.above.nextSibling)
    })

    window.addEventListener('scroll', () => window.requestAnimationFrame(update))
    update()

    function update () {
      const y = window.scrollY
      const windowHeight = window.innerHeight

      previews.forEach(preview => {
        const { height } = preview.getBoundingClientRect()

        if (preview.offsetTop + height <= y + windowHeight / 2) {
          if (preview.below) preview.below.style.display = ''
          if (preview.above) preview.above.style.display = 'none'
        } else {
          if (preview.below) preview.below.style.display = 'none'
          if (preview.above) preview.above.style.display = ''
        }
      })
    }
  }
})
