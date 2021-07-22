import { getLoadMoreBtn } from './templates'
import { getCommentsAPI } from './api'

export function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;')
}

export function addCommentToDom(container, comment, isPrepend) {
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

export function getLastId(data) {
  return data[data.length - 1].id
}

export function addMoreBtnOrNot(baseUrl, siteKey, lastId, btnClassName, container) {
  getCommentsAPI(baseUrl, siteKey, lastId, (data) => {
    if (!data.ok) {
      alert(data.message)
      return
    }
    const { comments } = data
    const { length } = comments
    if (length > 0) {
      const loadMoreBtn = getLoadMoreBtn(btnClassName)
      container.append(loadMoreBtn)
    }
  })
}
