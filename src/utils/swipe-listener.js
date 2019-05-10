import noop from 'utils/noop'

export default (element, handler = noop) => {
  let touchstartX = 0
  let touchstartY = 0
  let touchendX = 0
  let touchendY = 0

  element.addEventListener('touchstart', function (event) {
    touchstartX = event.changedTouches[0].screenX
    touchstartY = event.changedTouches[0].screenY
  }, false)

  element.addEventListener('touchend', function (event) {
    touchendX = event.changedTouches[0].screenX
    touchendY = event.changedTouches[0].screenY
    handler({
      delta: [
        touchstartX - touchendX,
        touchstartY - touchendY
      ]
    })
  }, false)
}
