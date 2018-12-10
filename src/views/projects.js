import view from 'abstractions/barba-view'
import tableSorter from 'controllers/table-sorter'
import imageShuffler from 'controllers/image-shuffler'

export default view('projects', {
  onEnterCompleted: refs => {
    refs.tableSorter = tableSorter({
      element: document.querySelector('.projects-list'),
      headers: document.querySelectorAll('.projects-list__header-label span'),
      container: document.querySelector('.projects-list__items'),
      rowsSelector: '.projects-list__item',
      columnsSelector: 'a > div'
    })

    refs.imageShuffler = imageShuffler({
      elements: document.querySelectorAll('.projects-list__item-cover'),
      margin: ['112px', '500px', '300px', '35%']
    })
  }
})
