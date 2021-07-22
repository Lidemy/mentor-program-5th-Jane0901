const baserUrl = 'https://api.twitch.tv/kraken/'
const headers = {
  headers: new Headers({
    'Client-ID': '14vx97stm6rnl86ikqntvuizaes0z8',
    Accept: 'application/vnd.twitchtv.v5+json'
  })
}
const navbar = document.querySelector('.navbar__games')
const title = document.querySelector('h1')
const page = document.querySelector('.streams')
const errorMessage = '系統問題，請稍候'
const streamTemplate = `
 <div class="stream">
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
    </div>
  </div>
  `

getTopGames()

navbar
  .addEventListener('click', (e) => {
    const gameClicked = e.target.innerText
    const gameOrigin = title.innerText
    if (!(gameClicked === gameOrigin)) {
      changPage(gameClicked)
    }
  })

async function getTopGames() {
  const apiUrl = `${baserUrl}games/top?limit=5`
  try {
    const response = await fetch(apiUrl, headers)
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    const jsonData = await response.json()
    const games = jsonData.top
    appendGamesNavbar(games)
    changPage(games[0].game.name)
  } catch (error) {
    alert(errorMessage)
  }
}

async function getLiveSteam(gameName) {
  const apiUrl = `${baserUrl}streams/?limit=20&game=${encodeURIComponent(gameName)}`
  try {
    const response = await fetch(apiUrl, headers)
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    return await response.json()
  } catch (error) {
    alert(errorMessage)
  }
}

function appendGamesNavbar(games) {
  for (const game of games) {
    const gameName = game.game.name
    const li = document.createElement('li')
    li.classList.add('navbar__game-name')
    li.innerHTML = `<a href="#">${gameName}</a>`
    navbar.appendChild(li)
  }
}

async function changPage(gameName) {
  page.innerHTML = ''
  title.innerText = gameName
  const data = await getLiveSteam(gameName)
  appendStreamDiv(data.streams)
}

function appendStreamDiv(streams) {
  for (const stream of streams) {
    const previewURL = stream.preview.large
    const { logo: logeURL, status: title, display_name: name } = stream.channel
    const div = document.createElement('div')
    page.appendChild(div)
    div.outerHTML = streamTemplate
      .replace('$preview', previewURL)
      .replace('$loge', logeURL)
      .replace('$title', title)
      .replace('$name', name)
  }
  appendEmptyDiv()
}

function appendEmptyDiv() {
  const div = document.createElement('div')
  page.appendChild(div)
  div.outerHTML = `
    <div class = "empty"></div>
    <div class = "empty"></div>
  `
}
