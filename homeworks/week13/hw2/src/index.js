/* eslint-disable import/prefer-default-export */
import $ from 'jquery'
import { getCommentsAPI, addCommentsAPI } from './api'
import { addCommentToDom, getLastId, addMoreBtnOrNot } from './utils'
import { getForm } from './templates'

export function init(options) {
  const { siteKey, baseUrl } = options
  const containerElement = $(options.containerSelector)
  const loadMoreClassName = `${siteKey}-load-more`
  const commentsClassName = `${siteKey}-board__comments`
  const commentsSelector = `.${commentsClassName}`
  const formClassName = `${siteKey}-board__add-comment`
  const formSelector = `.${formClassName}`
  let lastId = null
  let isClicked = false
  containerElement.append(getForm(formClassName, commentsClassName))
  const boardCommentsDiv = $(commentsSelector)
  getCommentsAPI(baseUrl, siteKey, lastId, (data) => {
    if (!data.ok) {
      alert(data.message)
      return
    }
    const { comments } = data
    for (const comment of comments) addCommentToDom(boardCommentsDiv, comment)
    lastId = getLastId(comments)
    addMoreBtnOrNot(baseUrl, siteKey, lastId, loadMoreClassName, boardCommentsDiv)
  })

  $(commentsSelector).on('click', `.${loadMoreClassName}`, () => {
    $(`.${loadMoreClassName}`).hide()
    getCommentsAPI(baseUrl, siteKey, lastId, (data) => {
      if (!data.ok) {
        alert(data.message)
        return
      }
      const { comments } = data
      for (const comment of comments) addCommentToDom(boardCommentsDiv, comment)
      lastId = getLastId(comments)
      addMoreBtnOrNot(baseUrl, siteKey, lastId, loadMoreClassName, boardCommentsDiv)
    })
  })

  $(formSelector).submit((e) => {
    if (isClicked) return
    isClicked = true
    const nicknameDom = $(`${formSelector} input[name = nickname]`)
    const contentDom = $(`${formSelector} textarea[name = content]`)
    const newCommentData = {
      site_key: siteKey,
      nickname: nicknameDom.val(),
      content: contentDom.val()
    }
    e.preventDefault()
    addCommentsAPI(baseUrl, siteKey, newCommentData, (data) => {
      if (!data.ok) {
        alert(data.message)
        return
      }

      nicknameDom.val('')
      contentDom.val('')

      // 拿資料庫的 created_at ，再顯示新增的留言內容
      getCommentsAPI(baseUrl, siteKey, null, (data) => {
        if (!data.ok) {
          alert(data.message)
          return
        }
        newCommentData.created_at = data.comments[0].created_at
        addCommentToDom(boardCommentsDiv, newCommentData, true)
      })
    })
  })
}
