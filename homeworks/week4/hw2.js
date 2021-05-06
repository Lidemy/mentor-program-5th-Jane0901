/* eslint-disable prefer-arrow-callback, import/no-extraneous-dependencies */
const request = require('request')

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
    'https://lidemy-book-store.herokuapp.com/books?_limit=20',
    function(error, response, body) {
      const json = JSON.parse(body)
      for (let i = 0; i < json.length; i++) {
        console.log(`${json[i].id} ${json[i].name}`)
      }
    }
  )
}

function returnBook() {
  request(
    `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
    function(error, response, body) {
      const json = JSON.parse(body)
      console.log(`${json.id} ${json.name}`)
    }
  )
}

function deleteBook() {
  request.delete({
    url: `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`
  },
  function(error, response, body) {
    console.log(response.statusCode)
  })
}

function createBook() {
  request.post({
    url: 'https://lidemy-book-store.herokuapp.com/books',
    form: {
      name: process.argv[3]
    }
  },
  function(error, response, body) {
    const json = JSON.parse(body)
    console.log(json)
  })
}

function updateBook() {
  request.patch({
    url: `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
    form: {
      name: process.argv[4]
    }
  },
  function(error, response, body) {
    const json = JSON.parse(body)
    console.log(json)
  })
}
