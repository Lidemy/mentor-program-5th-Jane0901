document
  .querySelector('form')
  .addEventListener('submit', (e) => {
    const elements = document.querySelectorAll('.required')
    let hasError = false
    for (const element of elements) {
      let isEmpty = true
      if (element.type === 'text') {
        if (!(element.value.length === 0)) {
          isEmpty = false
        }
      } else {
        const radios = element.querySelectorAll('input[type=radio]')
        if (radios[0].checked || radios[1].checked) {
          isEmpty = false
        }
      }

      if (isEmpty) {
        element.parentNode.classList.remove('hide-error')
        e.preventDefault()
        hasError = true
      } else {
        element.parentNode.classList.add('hide-error')
      }
    }

    const result = document.querySelectorAll('.form__answer')

    let applyType = '躺在床上用想像力實作'
    const options = document.querySelectorAll('input[type=radio]')
    if (options[1].checked) {
      applyType = '趴在地上滑手機找現成的'
    }

    if (!hasError) {
      alert(`暱稱：${result[0].value}
電子郵件：${result[1].value}
手機號碼：${result[2].value}
報名類型：${applyType}
怎麼知道這個活動的：${result[4].value}
其他：${result[5].value}`)
    }
  })
