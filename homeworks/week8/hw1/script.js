const apiURL = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery'
const errorMessage = '系統不穩定，請再試一次'
function draw(callback) {
  const error = true
  const request = new XMLHttpRequest()
  request.open('GET', apiURL, true)
  request.onload = function() {
    let prizeResult
    if (request.status >= 200 && request.status < 400) {
      try {
        prizeResult = JSON.parse(request.responseText).prize
      } catch (err) {
        callback(error)
        return
      }
    } else {
      callback(error)
      return
    }

    if (!prizeResult) {
      callback(error)
      return
    }

    callback(null, prizeResult)
  }

  request.onerror = function() {
    callback(error)
  }

  request.send()
}

document
  .querySelector('.section')
  .addEventListener('click', (e) => {
    if (e.target.classList.contains('result__btn')) {
      window.location.reload()
    }

    if (e.target.classList.contains('lottery__btn')) {
      draw((error, prizeResult) => {
        if (error) return alert(errorMessage)

        let className
        let prizeDetail
        switch (prizeResult) {
          case 'FIRST':
            className = 'first-prize'
            prizeDetail = '恭喜你中頭獎了！日本東京來回雙人遊！'
            break
          case 'SECOND':
            className = 'second-prize'
            prizeDetail = '二獎！90 吋電視一台！'
            break
          case 'THIRD':
            className = 'third-prize'
            prizeDetail = '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！'
            break
          case 'NONE':
            className = 'none-prize'
            prizeDetail = '銘謝惠顧'
            break
        }
        document.querySelector('.lottery__card').classList.add('hide')
        document.querySelector('.result').classList.remove('hide')
        document.querySelector('.result__prize').innerText = prizeDetail
        document.querySelector('.section').classList.add(className)
      })
    }
  })
