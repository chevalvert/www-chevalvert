import Barba from 'barba.js'
import noop from 'utils/noop'

export default (namespace, {
  onEnter = noop,
  onEnterCompleted = noop,
  onLeave = noop,
  onLeaveCompleted = noop
} = {}) => {
  namespace.split('|').forEach(ns => {
    Barba.BaseView.extend({
      namespace: ns,

      // The new Container is ready and attached to the DOM
      onEnter () {
        this.refs = {}
        onEnter(this.refs)
      },

      // The Transition has just finished
      onEnterCompleted () {
        onEnterCompleted(this.refs)
      },

      // A new Transition toward a new page has just started
      onLeave () {
        onLeave(this.refs)
        Object.values(this.refs).forEach(ref => ref && ref.destroy && ref.destroy())
        this.refs = undefined
      },

      // The Container has just been removed from the DOM
      onLeaveCompleted () {
        onLeaveCompleted()
      }
    }).init()
  })
}
