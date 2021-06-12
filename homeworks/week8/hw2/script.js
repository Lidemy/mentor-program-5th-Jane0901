const clientID = '14vx97stm6rnl86ikqntvuizaes0z8'
const acceptString = 'application/vnd.twitchtv.v5+json'
const apiURL = 'https://api.twitch.tv/kraken/'
const errorMessage = '系統問題，請稍候'
const streamTemplte = `<div class="stream">
  <div class="stream__preview">
    <img src="$preview">
  </div>
  <div class="stream__info">
    <div class="stream__logo">
      <img src="$loge">
    </div>
  <div class="stream__content">
    <p class="stream__title">$title</p>
    <p class="stream__broadcaster">$name</p>
  </div>
  </div>`

getTopGames((error, games) => {
  if (error) {
    alert(errorMessage)
  }

  for (const game of games) {
    const gameName = game.game.name
    const li = document.createElement('li')
    li.classList.add('navbar__game-name')
    li.innerHTML = `<a href="#">${gameName}</a>`
    document.querySelector('.navbar__games').appendChild(li)
  }

  changPage(games[0].game.name)
})

document
  .querySelector('.navbar__games')
  .addEventListener('click', (e) => {
    const gameClicked = e.target.innerText
    const gameOrigin = document.querySelector('h1').innerText
    if (!(gameClicked === gameOrigin)) {
      changPage(gameClicked)
    }
  })

function getTopGames(callback) {
  const request = new XMLHttpRequest()
  request.open('GET', `${apiURL}games/top?limit=5`, true)
  request.setRequestHeader('Client-ID', clientID)
  request.setRequestHeader('Accept', acceptString)
  const error = true
  request.onload = function() {
    let games
    if (request.status >= 200 && request.status < 400) {
      try {
        games = JSON.parse(request.responseText).top
      } catch (e) {
        callback(error)
        return
      }
    } else {
      callback(error)
      return
    }

    if (!games) {
      callback(error)
      return
    }

    callback(null, games)
  }

  request.onerror = function() {
    callback(error)
  }

  request.send()
}

function getLiveSteam(game, callback) {
  const request = new XMLHttpRequest()
  request.open('GET', `${apiURL}streams/?limit=20&game=${encodeURIComponent(game)}`, true)
  request.setRequestHeader('Client-ID', clientID)
  request.setRequestHeader('Accept', acceptString)
  const error = true
  request.onload = function() {
    let streams
    if (request.status >= 200 && request.status < 400) {
      try {
        streams = JSON.parse(request.responseText).streams
      } catch (e) {
        callback(error)
        return
      }
    } else {
      callback(error)
      return
    }

    if (!streams) {
      callback(error)
      return
    }

    callback(null, streams)
  }

  request.onerror = function() {
    callback(error)
  }

  request.send()
}

function changPage(gameName) {
  document.querySelector('.streams').innerHTML = ''
  document.querySelector('h1').innerText = gameName
  getLiveSteam(gameName, (error, streams) => {
    if (error) {
      alert(errorMessage)
    }

    appendStreamDiv(streams)
  })
}

function appendStreamDiv(streams) {
  for (const stream of streams) {
    const previewURL = stream.preview.large
    const logeURL = stream.channel.logo
    const title = stream.channel.status
    const name = stream.channel.display_name
    const div = document.createElement('div')
    document.querySelector('.streams').appendChild(div)
    div.outerHTML = streamTemplte
      .replace('$preview', previewURL)
      .replace('$loge', logeURL)
      .replace('$title', title)
      .replace('$name', name)
  }
  const div = document.createElement('div')
  document.querySelector('.streams').appendChild(div)
  div.outerHTML = `<div class = "empty"></div>
  <div class = "empty"></div>`
}
