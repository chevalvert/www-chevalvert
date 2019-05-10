import view from 'abstractions/barba-view'
import fullscreen from 'controllers/fullscreen'

export default view('project', {
  onEnterCompleted: refs => {
    refs.fullscreen = fullscreen({
      selector: '.project-gallery li [data-fullscreen]'
    })
  }
})
