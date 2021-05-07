/* eslint-disable import/no-extraneous-dependencies */
const request = require('request')

const options = {
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    'Client-ID': '14vx97stm6rnl86ikqntvuizaes0z8',
    Accept: 'application/vnd.twitchtv.v5+json'
  }
}
function callback(error, reponse, body) {
  let data
  try {
    data = JSON.parse(body)
  } catch (error) {
    console.log(error)
    return
  }
  for (let i = 0; i < data.top.length; i++) {
    console.log(`${data.top[i].viewers} ${data.top[i].game.name}`)
  }
}

request(options, callback)
