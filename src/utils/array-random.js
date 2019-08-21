import intersectionOf from 'utils/array-intersection'

/**
 * Pick a random entry of an array, not picking any value of the exclude array.
 * If no values can be picked because of the exclude array, skip the exclude
 * array.
 * A custom RNG can be specified.
 */
function randomOf (arr, { exclude = undefined, prng = Math.random } = {}) {
  const excludedValues = Array.isArray(exclude) ? exclude : [exclude]
  const possibleValues = excludedValues && excludedValues.length
    ? arr.filter(v => !excludedValues.includes(v))
    : arr

  const allValuesAreExcluded = intersectionOf(possibleValues, excludedValues).length === possibleValues.length
  return allValuesAreExcluded
    ? randomOf(arr, { exclude: undefined, prng })
    : possibleValues[Math.floor(prng() * possibleValues.length)]
}

export default randomOf
