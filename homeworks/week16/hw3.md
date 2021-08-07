**題目**
```javascript
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

**答案**
```
undefined
5
6
20
1
10
100
```

**說明**

1. Global 的編譯階段：
- 宣告一個變數叫做 a。
- 宣告一個函式叫做 fn。
```
Global VO: {
  a: undefined
  fn: function
}
```

2. Global 的執行階段：
- 對 a 賦值為 １。
```
Global VO: {
  a: 1
  fn: function
}
```
- 執行 fn。

3. fn 的編譯階段：
- 宣告一個變數叫做 a。
- 宣告一個函式叫做 fn2。
```
fn VO: {
  a: undefined
  fn2: function
}

Global VO: {
  a: 1
  fn: function
}
```

4. fn 的執行階段：
- 執行 `console.log(a)`，因為 fn scope 裡的 a 為 undefined，所以印出 undefined。
- 對 a 賦值為 5。
```
fn VO: {
  a: 5
  fn2: function
}

Global VO: {
  a: 1
  fn: function
}
```
- 執行 `console.log(a)`，因為 fn scope 裡的 a 為 5，所以印出 5。
- 執行 `a++`，a 新的賦值為 6。
```
fn VO: {
  a: 6
  fn2: function
}

Global VO: {
  a: 1
  fn: function
}
```
- 執行 fn2。

5. fn2 的編譯階段，VO 沒有內容：
```
fn2 VO: {}

fn VO: {
  a: 20
  fn2: function
}

Global VO: {
  a: 1
  fn: function
}
```

6. fn2 的執行階段：
- 執行 `console.log(a)` ，fn2 scope 沒有 a，往上層找到 fn scope 裡的 a 為 6，所以印出 6。
- 對 a 賦值為 20，不過因為 fn2 scope 沒有 a，所以找到上層 fn scope，改變裡面的 a。
```
fn2 VO: {}

fn VO: {
  a: 20
  fn2: function
}

Global VO: {
  a: 1
  fn: function
}
```
- 對 b 賦值為 100，不過因為 fn2 scope 沒有 b，上層的 fn scope 也沒有 b，所以找到最後的 Global scope，加上 b 並設定為 100。
```
fn2 VO: {}

fn VO: {
  a: 20
  fn2: function
}

Global VO: {
  a: 1
  fn: function
  b: 100
}
```

7. fn2 的執行階段結束，回到 fn 的執行階段：
```
fn VO: {
  a: 20
  fn2: function
}

Global VO: {
  a: 1
  fn: function
  b: 100
}
```
- 執行 `console.log(a)`，因為 fn scope 裡的 a 為 20，所以印出 20。

8. fn 的執行階段結束，回到 Global 的執行階段：
```
Global VO: {
  a: 1
  fn: function
  b: 100
}
```
- 執行 `console.log(a)`，因為 Global scope 裡的 a 為 1，所以印出 1。
- 對 a 重新賦值為 10。
```
Global VO: {
  a: 10
  fn: function
  b: 100
}
```
- 執行 `console.log(a)`，因為 Global scope 裡的 a 為 10，所以印出 10。
- 執行 `console.log(b)`，因為 Global scope 裡的 b 為 100，所以印出 100。
