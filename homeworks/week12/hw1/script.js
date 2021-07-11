/* eslint-disable no-undef */
const siteKey = 'jane'
const loadMoreBtn = '<button type="submit" class="btn btn-primary mb-3 load-more">載入更多</button>'
let lastId = null
let isEnd = false
const baseUrl = 'http://mentor-program.co/mtr04group1/jane/week12/hw1'

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

function addMoreBtnOrNot(container) {
  getCommentsAPI(siteKey, lastId, (data) => {
    if (!data.ok) {
      alert(data.message)
      return
    }
    const { comments } = data
    const { length } = comments
    if (length === 0) {
      isEnd = true
    } else {
      container.append(loadMoreBtn)
    }
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
    addMoreBtnOrNot(boardCommentsDiv)
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
    const newCommentData = {
      site_key: siteKey,
      nickname: $('input[name = nickname]').val(),
      content: $('textarea[name = content]').val()
    }
    e.preventDefault()
    $.ajax({
      type: 'POST',
      url: `${baseUrl}/api_add_comments.php?site_key=jane`,
      data: newCommentData
    }).done((data) => {
      if (!data.ok) {
        alert(data.message)
        return
      }

      $('input[name = nickname]').val('')
      $('textarea[name = content]').val('')

      // 拿資料庫的 created_at ，再顯示新增的留言內容
      getCommentsAPI(siteKey, null, (data) => {
        if (!data.ok) {
          alert(data.message)
          return
        }
        newCommentData.created_at = data.comments[0].created_at
        addCommentToDom(boardCommentsDiv, newCommentData, true)
      })
    })
  })
})
