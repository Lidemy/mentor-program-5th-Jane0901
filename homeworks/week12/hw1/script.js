/* eslint-disable no-undef */
const siteKey = 'jane'
const loadMoreBtn = '<button type="submit" class="btn btn-primary mb-3 load-more">載入更多</button>'
let lastId = null
let isEnd = false
const baseUrl = 'http://192.168.64.2/discussions'

function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;')
}

function addCommentToDom(container, comment, isPrepend) {
  const html = `
      <div class="card mb-3">
        <h5 class="card-header">
          ${escapeHtml(comment.nickname)}
          <span class="badge text-dark">${escapeHtml(comment.created_at)}</span>
        </h5>
        <div class="card-body">
          <p class="card-text">${escapeHtml(comment.content)}</p>
        </div>
      </div>
  `
  if (isPrepend) {
    container.prepend(html)
  } else {
    container.append(html)
  }
}

function getCommentsAPI(siteKey, before, cb) {
  let url = `${baseUrl}/api_comments.php?site_key=${siteKey}`
  if (before) {
    url += `&before=${before}`
  }
  $.ajax({
    url
  }).done((data) => {
    cb(data)
  })
}

function getComment() {
  const boardCommentsDiv = $('.board__comments')
  if (isEnd) return
  getCommentsAPI(siteKey, lastId, (data) => {
    if (!data.ok) {
      alert(data.message)
      return
    }
    const { comments } = data
    for (const comment of comments) {
      addCommentToDom(boardCommentsDiv, comment)
    }
    lastId = comments[comments.length - 1].id

    // 判斷是否加上 loadMoreBtn
    getCommentsAPI(siteKey, lastId, (data) => {
      if (!data.ok) {
        alert(data.message)
        return
      }
      const { comments } = data
      const { length } = comments
      if (length === 0) {
        isEnd = true
        $('.load-more').hide()
      } else {
        boardCommentsDiv.append(loadMoreBtn)
      }
    })
  })
}

$(document).ready(() => {
  getComment()

  $('.board__comments').on('click', '.load-more', () => {
    $('.load-more').hide()
    getComment()
  })

  $('.board__add-comment').submit((e) => {
    const boardCommentsDiv = $('.board__comments')
    e.preventDefault()
    $.ajax({
      type: 'POST',
      url: `${baseUrl}/api_add_comments.php?site_key=jane`,
      data: {
        site_key: siteKey,
        nickname: $('input[name = nickname]').val(),
        content: $('textarea[name = content]').val()
      }
    }).done((data) => {
      if (!data.ok) {
        alert(data.message)
        return
      }

      $('input[name = nickname]').val('')
      $('textarea[name = content]').val('')

      // 顯示新增的留言
      getCommentsAPI(siteKey, null, (data) => {
        if (!data.ok) {
          alert(data.message)
          return
        }
        const newCommentData = data.comments[0]
        addCommentToDom(boardCommentsDiv, newCommentData, true)
      })
    })
  })
})
