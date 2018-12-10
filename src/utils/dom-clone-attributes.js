export default (nodeA, nodeB) => {
  if (!nodeA || !nodeB) return
  ;[...nodeA.attributes].forEach(({ nodeName, nodeValue }) => nodeB.setAttribute(nodeName, nodeValue))
}
