/* eslint-disable no-unused-vars */
function solve(lines) {
  const arr = lines[0].split(' ')
  const l = Number(arr[0])
  const u = Number(arr[1])
  for (let i = l; i <= u; i++) {
    if (isNarcissistic(i)) console.log(i)
  }
}

function isNarcissistic(n) {
  const str = n.toString()
  let sum = 0
  for (let j = 0; j < str.length; j++) {
    sum += Math.pow(str[j], str.length)
  }
  return sum === n
}
