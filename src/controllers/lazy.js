import 'intersection-observer'
import lozad from 'lozad'

export default ({
  selector = '[data-lozad]',
  parentAttribute = 'data-lozad-container'
} = {}) => {
  let observer = lozad(selector, {
    rootMargin: '200px',
    threshold: 0.1,
    loaded: el => {
      const parent = el.parentNode
      if (!parent || !parent.hasAttribute(parentAttribute)) return
      parent.setAttribute('data-loaded', true)
    }
  })
  observer.observe()

  return {
    destroy: () => {
      observer = undefined
    }
  }
}
