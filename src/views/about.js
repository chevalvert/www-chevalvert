import view from 'abstractions/barba-view'
import tocHighlighter from 'controllers/toc-highlighter'

export default view('about', {
  onEnterCompleted: refs => {
    refs.tocHighlighter = tocHighlighter({
      anchors: document.querySelectorAll('.about__sections a'),
      offset: 20
    })
  }
})
