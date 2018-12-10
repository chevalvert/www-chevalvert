import random from 'fast-random'

export default seed => {
  const prng = random(seed)
  return () => prng.nextFloat()
}
