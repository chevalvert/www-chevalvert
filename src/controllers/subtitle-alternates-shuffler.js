import randomOf from 'utils/array-random'

const NS = '__SUBTITLE-ALTERNATES-SHUFFLER.'

export default ({
  selector = '.menu__subtitle[data-alternates]'
} = {}) => {
  clearInterval(window[NS + 'timer'])

  const element = document.querySelector(selector)
  if (!element) return

  const alternates = element.getAttribute('data-alternates')
  const delay = element.getAttribute('data-alternates-delay')
  if (!alternates || !alternates.length || !delay) return

  window[NS + 'timer'] = setInterval(() => {
    element.innerHTML = randomOf(alternates.split(','))
  }, delay * 1000)
}
