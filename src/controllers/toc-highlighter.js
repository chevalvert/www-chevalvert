export default ({
  anchors = document.querySelectorAll('nav a'),
  offset = 0,
  activeClass = 'is-active'
} = {}) => {
  if (!anchors || !anchors.length) return

  anchors.forEach(anchor => {
    const url = anchor.getAttribute('href')
    const id = url[0] === '#' && url.substring(1)
    const element = document.getElementById(id)
    if (!element) return

    anchor.y = window.pageYOffset + element.getBoundingClientRect().top

    anchor.addEventListener('click', e => {
      e.preventDefault()
      window.scroll({
        top: anchor.y,
        behavior: 'smooth'
      })
    })
  })

  checkForActiveness()

  window.addEventListener('load', update)
  window.addEventListener('scroll', update)

  return {
    destroy: () => {
      window.removeEventListener('load', update)
      window.removeEventListener('scroll', update)
    }
  }

  function update () {
    window.requestAnimationFrame(checkForActiveness)
  }

  function checkForActiveness () {
    const y = window.pageYOffset
    for (let i = anchors.length - 1; i >= 0; i--) {
      const anchor = anchors[i]
      if (anchor.y < y + offset) {
        anchors.forEach(deactivate)
        activate(anchor)
        break
      }
    }
  }

  function activate (element) {
    if (element.classList.contains(activeClass)) return
    element.classList.add(activeClass)
  }

  function deactivate (element) {
    if (!element.classList.contains(activeClass)) return
    element.classList.remove(activeClass)
  }
}
