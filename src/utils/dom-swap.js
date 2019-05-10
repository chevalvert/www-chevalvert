export default (a, b) => {
  const cloneA = a.cloneNode(true)
  const cloneB = b.cloneNode(true)

  b.parentNode.replaceChild(cloneA, b)
  a.parentNode.replaceChild(cloneB, a)

  return cloneA
}
