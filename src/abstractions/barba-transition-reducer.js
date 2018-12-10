import Barba from 'barba.js'

// SEE: https://github.com/luruke/barba.js/issues/19#issuecomment-326475724
export default map => Barba.BaseTransition.extend({
  start () {
    this.newContainerLoading.then(() => {
      const from = Barba.Pjax.History.prevStatus().namespace
      const to = Barba.Pjax.History.currentStatus().namespace

      return ((map[from] && map[from][to]) || map.default)(
        this.oldContainer,
        this.newContainer,
        Barba.lastClickEl,
        this.done.bind(this),
      )
    })
  }
})
