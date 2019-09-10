import { debounce } from 'tiny-throttle'

import view from 'abstractions/barba-view'
import tocHighlighter from 'controllers/toc-highlighter'
import lastOf from 'utils/array-last-of'
import noop from 'utils/noop'

export default view('about', {
  onEnterCompleted: refs => {
    refs.tocHighlighter = tocHighlighter({
      anchors: document.querySelectorAll('.about__sections a'),
      anchorsScrollContainer: document.querySelector('.about__sections'),
      offset: 20
    })

    // NOTE: this allows the last .about-section to be big enough
    // to trigger controllers/toc-highlighter on its anchor
    // When last-child is not merged-with-previous-section, previous section
    // height does not have to be taken in consideration, which is possible in
    // pure CSS: SEE components/about-section.scss.
    const sections = document.querySelectorAll('.about-section')
    const mergedSection = lastOf(sections)
    refs.autofitLastMergedSection = mergedSection.classList.contains('is-merged-with-previous-section')
      ? debounce(() => {
        // Disable autofitting below a specific breakpoint (SEE sass/devices.scss)
        if (window.innerWidth < 1120) {
          mergedSection.style['height'] = 'auto'
          return
        }

        const sectionHeight = sections[sections.length - 2].offsetHeight
        const menuHeight = document.querySelector('.menu').offsetHeight
        const footerHeight = document.querySelector('.footer').offsetHeight
        const targetHeight = window.innerHeight - (menuHeight * 2) - footerHeight - sectionHeight + 22

        mergedSection.style['height'] = targetHeight + 'px'
      }, 50)
      : noop

    window.addEventListener('load', refs.autofitLastMergedSection)
    window.addEventListener('resize', refs.autofitLastMergedSection) // TODO: throttle
    refs.autofitLastMergedSection()
  },

  onLeave: refs => {
    window.removeEventListener('load', refs.autofitLastMergedSection)
    window.removeEventListener('resize', refs.autofitLastMergedSection)
  }
})
