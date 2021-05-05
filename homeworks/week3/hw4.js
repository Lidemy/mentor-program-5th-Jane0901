/* eslint-disable no-unused-vars */
function solve(lines) {
  const str = lines[0]
  let reverse = ''
  for (let i = str.length - 1; i >= 0; i--) {
    reverse += str[i]
  }
  console.log(reverse === str ? 'True' : 'False')
}
