export function getForm(className, commentsClassName) {
  return `
    <div>
      <form class="${className}">
        <div class="mb-3">
          <label class="form-label">暱稱</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="nickname">
        </div>
        <div class="mb-3">
          <label class="form-label">留言內容</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-5">送出</button>
      </form>
      <div class="${commentsClassName}"></div>
    </div>
  `
}

export function getLoadMoreBtn(className) {
  return `<button type="submit" class="btn btn-primary mb-3 ${className}">載入更多</button>`
}
