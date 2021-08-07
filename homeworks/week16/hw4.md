**題目與答案**
```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // 2
obj2.hello() // 2
hello() // undefined
```

**說明**
- `obj.inner.hello()`

轉成 `call` 的形式理解，會變成 `obj.inner.hello.call(obj.inner)`。執行 `console.log(this.value)`， 由於 call() 傳的第一個參數為 this 值，所以就是 `console.log(obj.inner.value)`，會印出 2。

- `obj2.hello()`

轉成 `call` 的形式理解，會變成 `obj2.hello.call(obj2)`。由於 `const obj2 = obj.inner`，知道 `obj2.hello.call(obj2)` 就是 `obj.inner.hello.call(obj.inner)`，所以印出 2。

- `hello()`

轉成 `call` 的形式理解，會變成 `hello.call()`。由於 `const hello = obj.inner.hello`，知道 `hello.call()` 就是 `obj.inner.hello.call()`。執行 `console.log(this.value)`，因為 call() 沒有傳入參數，所以 this 的值是預設值 window，最後印出 undefined。
