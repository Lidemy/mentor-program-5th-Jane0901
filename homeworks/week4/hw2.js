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
  case 'create':
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
      let book
      try {
        book = JSON.parse(body)
      } catch (error) {
        console.log(error)
        return
      }
      if (Object.keys(book).length === 0) console.log('有錯誤')
      console.log(`id: ${book.id}, name: ${book.name}`)
    }
  )
}

function deleteBook() {
  request.delete({
    url: `${API_ENDPOINT}/${process.argv[3]}`
  },
  function(error, response, body) {
    console.log(`已無 id ${process.argv[3]} 之書籍`)
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
    console.log(`id: ${book.id}, name: ${book.name} 新增成功`)
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
    if (Object.keys(book).length === 0) console.log('有錯誤')
    console.log(`id: ${book.id}, name: ${book.name}`)
  })
}
