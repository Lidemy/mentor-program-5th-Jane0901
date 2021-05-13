/* eslint-disable prefer-arrow-callback, import/no-extraneous-dependencies */
const request = require('request')

const API_ENDPOINT = 'https://lidemy-book-store.herokuapp.com/books'

switch (process.argv[2]) {
  case 'list':
    listBook()
    break
  case 'read':
    returnBook()
    break
  case 'delete':
    deleteBook()
    break
  case 'creat':
    createBook()
    break
  case 'update':
    updateBook()
    break
}

function listBook() {
  request(
    `${API_ENDPOINT}?_limit=20`,
    function(error, response, body) {
      let books
      try {
        books = JSON.parse(body)
      } catch (error) {
        console.log(error)
        return
      }
      for (let i = 0; i < books.length; i++) {
        console.log(`${books[i].id} ${books[i].name}`)
      }
    }
  )
}

function returnBook() {
  request(
    `${API_ENDPOINT}/${process.argv[3]}`,
    function(error, response, body) {
      let books
      try {
        books = JSON.parse(body)
      } catch (error) {
        console.log(error)
        return
      }
      console.log(`${books.id} ${books.name}`)
    }
  )
}

function deleteBook() {
  request.delete({
    url: `${API_ENDPOINT}/${process.argv[3]}`
  },
  function(error, response, body) {
    console.log('刪除成功')
  })
}

function createBook() {
  request.post({
    url: API_ENDPOINT,
    form: {
      name: process.argv[3]
    }
  },
  function(error, response, body) {
    let book
    try {
      book = JSON.parse(body)
    } catch (error) {
      console.log(error)
      return
    }
    console.log(`${book.id} ${book.name} 新增成功`)
  })
}

function updateBook() {
  request.patch({
    url: `${API_ENDPOINT}/${process.argv[3]}`,
    form: {
      name: process.argv[4]
    }
  },
  function(error, response, body) {
    let book
    try {
      book = JSON.parse(body)
    } catch (error) {
      console.log(error)
      return
    }
    console.log(`${book.id} ${book.name} 更新成功`)
  })
}
