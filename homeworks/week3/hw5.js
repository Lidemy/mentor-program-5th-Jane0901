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
    const temp = a
    a = b
    b = temp
  }
  if (a.length > b.length) {
    return 'A'
  } else if (a.length < b.length) {
    return 'B'
  }
  for (let j = 0; j < a.length; j++) {
    if (a[j] > b[j]) {
      return 'A'
    } else if (a[j] < b[j]) {
      return 'B'
    }
  }
}
