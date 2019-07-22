import randomOf from 'utils/array-random'
import lastOf from 'utils/array-last-of'

const NS = '__SUBTITLE-ALTERNATES-SHUFFLER.'

export default ({
  selector = '.menu__subtitle[data-alternates]'
} = {}) => {
  clearInterval(window[NS + 'timer'])

  const element = document.querySelector(selector)
  if (!element) return

  const alternates = element.getAttribute('data-alternates')
  const delay = element.getAttribute('data-alternates-delay') || 1000
  if (!alternates || !alternates.length || !delay) return

  element.addEventListener('click', () => {
    element.innerHTML = lastOf(alternates.split(element.innerHTML + ',')).split(',')[0]
  })

  window[NS + 'timer'] = setInterval(() => {
    element.innerHTML = randomOf(alternates.split(','))
  }, delay * 1000)
}
