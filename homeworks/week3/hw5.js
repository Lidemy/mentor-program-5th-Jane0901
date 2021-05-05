/* eslint-disable no-unused-vars */
function solve(lines) {
  for (let i = 1; i < lines.length; i++) {
    const [a, b, p] = lines[i].split(' ')
    console.log(compare(a, b, p))
  }
}

function compare(a, b, p) {
  if (a === b) return 'DRAW'
  if (p === '-1') {
    [a, b] = [b, a]
  }
  if (a.length !== b.length) {
    return a.length > b.length ? 'A' : 'B'
  }
  return a > b ? 'A' : 'B'
}
