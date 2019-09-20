const CACHED_VALUES = {}
const STYLE = window.getComputedStyle(document.documentElement)

export default varName => {
  if (!CACHED_VALUES.hasOwnProperty(varName)) {
    CACHED_VALUES[varName] = STYLE.getPropertyValue(varName)
  }
  return CACHED_VALUES[varName]
}
