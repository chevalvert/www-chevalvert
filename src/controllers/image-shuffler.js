import 'nodelist-foreach'
import isMobile from 'utils/is-mobile'
import seedableRandom from 'utils/seedable-random'
import { lerp } from 'missing-math'

export default ({
  elements = document.querySelectorAll('img'),
  margin = [0, 0, 0, 0]
} = {}) => {
  if (isMobile()) return
  if (!elements || !elements.length) return

  const seed = Math.random() * 1000

  elements.forEach(element => {
    element.style.transform = 'none'
    element.width = element.offsetWidth
    element.height = element.offsetHeight
  })

  update()
  window.addEventListener('resize', update)

  return {
    destroy: () => {
      window.removeEventListener('resize', update)
    }
  }

  function update () {
    window.requestAnimationFrame(() => {
      const random = seedableRandom(seed)
      const width = window.innerWidth
      const height = window.innerHeight

      const area = [
        toPixel(margin[0], height),
        width - toPixel(margin[1], width),
        height - toPixel(margin[2], height),
        toPixel(margin[3], width)
      ]

      elements.forEach(element => {
        element.style.left = lerp(area[3], area[1], random()) + 'px'
        element.style.top = lerp(area[0], area[2], random()) + 'px'
      })
    })
  }

  function toPixel (value, dimension) {
    if (!isNaN(value)) return Math.round(value * dimension)
    if (~value.indexOf('px')) return parseInt(value)
    if (~value.indexOf('%')) return Math.round((parseFloat(value) / 100) * dimension)
  }
}
