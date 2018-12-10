import view from 'abstractions/barba-view'
import imageZoom from 'controllers/image-zoom'

export default view('project', {
  onEnterCompleted: refs => {
    refs.imageZoom = imageZoom({
      selector: '.project-gallery li [data-zoom]'
    })
  }
})
