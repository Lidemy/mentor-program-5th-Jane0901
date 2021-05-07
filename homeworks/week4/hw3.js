/* eslint-disable prefer-arrow-callback, import/no-extraneous-dependencies */
const request = require('request')

const str = process.argv[2]

request(
  `https://restcountries.eu/rest/v2/name/${str}`,
  function(error, response, body) {
    let country
    try {
      country = JSON.parse(body)
    } catch (error) {
      console.log(error)
      return
    }
    if (country.status === 404) return console.log('找不到國家資訊')
    for (let i = 0; i < country.length; i++) {
      console.log(
        `============
國家： ${country[i].name}
首都： ${country[i].capital}
貨幣： ${country[i].currencies[0].code}
國碼： ${country[i].callingCodes}`
      )
    }
  }
)
