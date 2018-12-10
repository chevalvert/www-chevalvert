import 'nodelist-foreach'

export default ({
  element,
  headers = document.querySelectorAll('table header'),
  container = document.querySelector('table'),
  rowsSelector = 'table tr',
  columnsSelector = 'td',
  directions = { ASC: -1, DESC: 1 }
} = {}) => {
  if (!element) return
  if (!container) return
  if (!headers || !headers.length) return

  headers.forEach((header, index) => {
    header.sorter = makeSorter(index).bind(header)
    header.addEventListener('click', header.sorter)
  })

  return {
    destroy: undefined
  }

  function makeSorter (columnIndex) {
    return function (e) {
      e.preventDefault()
      let isSorting = this.classList.contains('is-sorting')
      flipHeaderSortDirection(this)

      if (!isSorting) {
        clearSorting()
        this.classList.add('is-sorting')
      }

      sort(columnIndex, this.getAttribute('data-sort'))
    }
  }

  function clearSorting () {
    headers.forEach(header => {
      if (!header.classList.contains('is-sorting')) return
      header.classList.remove('is-sorting')
      header.removeAttribute('data-sort')
    })
  }

  function flipHeaderSortDirection (header) {
    const direction = Object.keys(directions).find(dir => dir !== header.getAttribute('data-sort'))
    header.setAttribute('data-sort', direction)
  }

  function sort (columnIndex, dirKey = 'ASC') {
    let switching = true
    let shouldSwitch
    let dir = 1
    let switchcount = 0

    while (switching) {
      switching = false
      const rows = container.querySelectorAll(rowsSelector)
      for (var i = 0; i < rows.length - 1; i++) {
        shouldSwitch = false

        const aEl = rows[i].querySelectorAll(columnsSelector)[columnIndex]
        const bEl = rows[i + 1].querySelectorAll(columnsSelector)[columnIndex]

        const a = aEl.innerHTML.toLowerCase()
        const b = bEl.innerHTML.toLowerCase()

        if (dir > 0) {
          if (a > b) {
            shouldSwitch = true
            break
          }
        } else {
          if (a < b) {
            shouldSwitch = true
            break
          }
        }
      }

      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i])
        switching = true
        switchcount++
      } else {
        if (switchcount === 0 && dir > 0) {
          dir = -1
          switching = true
        }
      }
    }
  }
}
