export default (oldContainer, newContainer, lastClickEl, done) => {
  if (lastClickEl && !lastClickEl.hasAttribute('data-lang-switcher')) window.scrollTo(0, 0)
  return done()
}
