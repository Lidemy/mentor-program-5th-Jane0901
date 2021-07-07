/* eslint-disable no-undef */
let todoID = 1
const baseUrl = 'http://192.168.64.2/todolist'

$(document).ready(() => {
  const todoIdByGet = new URLSearchParams(window.location.search).get('id')
  if (todoIdByGet) {
    $.getJSON(`${baseUrl}/api_get_todo.php?id=${todoIdByGet}`, (responseData) => {
      let todos
      try {
        todos = JSON.parse(responseData.data.todo)
      } catch (error) {
        console.log(error)
        return
      }
      if (!todos) {
        window.location = 'index.html'
        return
      }
      restoreTodos(todos)
      updateActiveCount()
    })
  }

  updateActiveCount()
  $(document).keydown((e) => {
    const todo = $('.todo__input').val()
    const atCompletedPage = $('.completed-btn')[0].checked
    if (e.keyCode === 13 && todo) {
      if (atCompletedPage) {
        addTodo(todo, todoID, false)
      } else {
        addTodo(todo, todoID, true)
      }
      $('.todo__input').val('')
      updateActiveCount()
    }
  })

  $(document).on('click', '.del-one', (e) => {
    $(e.target.closest('.todo__item')).remove()
    updateActiveCount()
  })

  $(document).on('click', '.form-check-input', (e) => {
    const atActivePage = $('.active-btn')[0].checked
    const atCompletedPage = $('.completed-btn')[0].checked
    const completedTodo = $('input[type=checkbox]:checked').closest('.todo__item')
    const activeTodo = $('input[type=checkbox]:not(:checked)').closest('.todo__item')
    $(e.target).siblings('.form-check-label').toggleClass('text-decoration-line-through text-muted')
    if (atActivePage) {
      completedTodo.hide()
    } else if (atCompletedPage) {
      activeTodo.hide()
    }
    updateActiveCount()
  })

  $(document).on('click', '.edit', (e) => {
    const editBtn = $(e.target.closest('.edit'))
    const editDoneBtn = $(e.target.closest('.edit')).next('.edit-done')
    const editInput = $(e.target.closest('.btn-group')).prev('.todo__item-edit')
    const label = $(e.target.closest('.btn-group')).siblings('.todo__item-name').children('label')
    editBtn.hide()
    editDoneBtn.show()
    label.text('')
    editInput.show()
  })

  $(document).on('click', '.edit-done', (e) => {
    const todo = $(e.target.closest('.btn-group')).prev('.todo__item-edit').val()
    const editDoneBtn = $(e.target.closest('.edit-done'))
    const editBtn = $(e.target.closest('.edit-done')).prev('.edit')
    const editInput = $(e.target.closest('.btn-group')).prev('.todo__item-edit')
    const label = $(e.target.closest('.btn-group')).siblings('.todo__item-name').children('label')
    editDoneBtn.hide()
    editBtn.show()
    editInput.hide()
    label.text(todo)
  })

  $('.filter-btns').click((e) => {
    const isActiveBtn = $(e.target).hasClass('active-btn')
    const isCompletedBtn = $(e.target).hasClass('completed-btn')
    const activeTodo = $('input[type=checkbox]:not(:checked)').closest('.todo__item')
    const completedTodo = $('input[type=checkbox]:checked').closest('.todo__item')
    if (isActiveBtn) {
      completedTodo.hide()
      activeTodo.show()
      return
    }
    if (isCompletedBtn) {
      activeTodo.hide()
      completedTodo.show()
      return
    }
    $('.todo__item').show()
  })

  $('.del-all-completed').click(() => {
    $('input[type=checkbox]:checked').closest('.todo__item').remove()
  })

  $('.save').click(() => {
    const todos = []
    $('.todo__item').each((i, element) => {
      const id = $(element).find('.form-check-input').attr('id').replace('todo-', '')
      const content = $(element).find('.form-check-label').text()
      todos.push({
        id,
        content,
        isDone: $(element).find('.form-check-input').is(':checked')
      })
    })
    const data = JSON.stringify(todos)
    saveTodos(todoIdByGet, data)
  })
})

function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;')
}

function addTodo(todo, id, show) {
  const todoDiv = `
    <div class="todo__item justify-content-between align-items-center pt-2 pb-2" ${show ? '' : 'style = "display: none"'}>
      <div class="todo__item-name form-check mb-0">
        <input class="form-check-input" type="checkbox" value="" id="todo-${id}">
        <label class="form-check-label" for="todo-${id}">${escapeHtml(todo)}</label>
      </div>
      <input class="todo__item-edit form-control" type="text" aria-label="default input example" value="${escapeHtml(todo)}" style = "display: none">
      <div class="btn-group  ms-4" role="group" aria-label="Basic outlined example">
        <button type="button" class="edit btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
        </svg></button>
        <button type="button" class="edit-done btn btn-outline-secondary" style = "display: none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
          <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
        </svg></button>
        <button type="button" class="del-one btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
        </svg></button>
      </div>
    </div>
  `
  $('.card-body').append(todoDiv)
  todoID = Number(id) + 1
}

function updateActiveCount() {
  const activeTodoNum = $('input[type=checkbox]:not(:checked)').length
  $('.count-checked').text(`${activeTodoNum} items left`)
}

function restoreTodos(todos) {
  for (const todo of todos) {
    addTodo(todo.content, todo.id, true)
    if (todo.isDone) {
      $(`#todo-${todo.id}`).prop('checked', true)
      $(`label[for=todo-${todo.id}]`).addClass('text-decoration-line-through text-muted')
    }
  }
}

function saveTodos(todoIdByGet, data) {
  const url = todoIdByGet ? `${baseUrl}/api_update_todos.php` : `${baseUrl}/api_add_todos.php`
  $.ajax({
    type: 'POST',
    url,
    data: {
      id: todoIdByGet,
      todo: data
    }
  }).done((responseData) => {
    if (responseData.ok) {
      window.location = `index.html?id=${responseData.id}`
      alert(`${responseData.message}你的 id 為 ${responseData.id}`)
    }
  }).fail(() => {
    alert('出現錯誤')
  })
}
