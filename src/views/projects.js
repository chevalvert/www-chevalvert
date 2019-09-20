import view from 'abstractions/barba-view'
import SASSVAR from 'controllers/sass-variables'

export default view('projects', {
  onEnterCompleted: refs => {
    const categories = document.querySelector('.projects-categories')
    const activeCategory = categories.querySelector('.is-active')
    if (!activeCategory) return

    const { left } = activeCategory.getBoundingClientRect()
    const siteMargin = parseFloat(SASSVAR('--site-margin')) * 10
    categories.scrollLeft = Math.floor(left - siteMargin)
  }
})
