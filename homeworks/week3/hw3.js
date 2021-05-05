/* eslint-disable no-unused-vars */
function solve(lines) {
  for (let i = 1; i < lines.length; i++) {
    console.log(isPrime(lines[i]))
  }
}

function isPrime(number) {
  if (number === 1) return 'Composite'
  const temp = []
  for (let j = 1; j <= number; j++) {
    if (number % j === 0) {
      temp.push(j)
    }
  }
  return (temp.length === 2) ? 'Prime' : 'Composite'
}
