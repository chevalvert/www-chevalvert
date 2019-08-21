import html from 'nanohtml'
import randomOf from 'utils/array-random'

let lastValue

export default ({
  selector = '.menu__subtitle[data-alternates]',
  clickCaptureSelector = 'span'
} = {}) => {
  const element = document.querySelector(selector)
  if (!element) return

  const alternates = element.getAttribute('data-alternates')
  if (!alternates || !alternates.length) return

  bind()
  update(lastValue)

  function bind () {
    const clicker = element.querySelector(clickCaptureSelector)
    if (!clicker) return

    clicker.addEventListener('click', () => {
      const newValue = randomOf(alternates.split(','), { exclude: lastValue })
      update(newValue)
    })
  }

  function update (value) {
    if (!value) return

    element.innerHTML = ''
    element.appendChild(html`<span>${value.trim()}</span>`)
    lastValue = value
    bind()
  }
}
