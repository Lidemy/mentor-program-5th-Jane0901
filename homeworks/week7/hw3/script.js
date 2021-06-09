document
  .querySelector('.list')
  .addEventListener('submit', (e) => {
    e.preventDefault()
    const inputValue = document.querySelector('.list__input').value
    if (!inputValue) return
    const div = document.createElement('div')
    div.classList.add('list__item-block')
    div.innerHTML = `
  <label>
    <input class="list__item" type="checkbox">${escapeHtml(inputValue)}
  </label>
  <button class="list__del-btn">x</button>`
    document.querySelector('.list').appendChild(div)
    document.querySelector('.list__input').value = ''

    function escapeHtml(unsafe) {
      return unsafe
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;')
    }
  })
document
  .querySelector('.list')
  .addEventListener('click', (e) => {
    const clickItem = e.target.classList.contains('list__item')
    const clickDel = e.target.classList.contains('list__del-btn')
    if (clickItem) {
      e.target.parentNode.classList.toggle('done')
    }
    if (clickDel) {
      e.preventDefault()
      document.querySelector('.list').removeChild(e.target.parentNode)
    }
  })
