**題目**
```javascript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```
**答案**
```
i: 0
i: 1
i: 2
i: 3
i: 4
5
5
5
5
5
```
**程式執行流程**
1. main thread 在 Call Stack 執行。
2. for 迴圈放入 Call Stack 執行。

- 第一圈迴圈，此時 `i = 0`，i 小於五。
  - 將 `console.log('i: ' + i)`， 放入 Call Stack，執行後顯示 `i: 0`，將此層從 Call Stack 移除。
  - 將 `setTimeout(() => {console.log(i)}, i * 1000)` 放入 Call Stack，瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 0 毫秒後，將 `() => {console.log(i)}` 放入 callback queue 排隊。
- 第二圈迴圈，此時 `i = 1`，i 小於五。
  - 將 `console.log('i: ' + i)`， 放入 Call Stack，執行後顯示 `i: 1`，將此層從 Call Stack 移除。
  - 將 `setTimeout(() => {console.log(i)}, i * 1000)` 放入 Call Stack，瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 1 毫秒後，將 `() => {console.log(i)}` 放入 callback queue 排隊。
- 第三圈迴圈，此時 `i = 2`，i 小於五。
  - 將 `console.log('i: ' + i)`， 放入 Call Stack，執行後顯示 `i: 2`，將此層從 Call Stack 移除。
  - 將 `setTimeout(() => {console.log(i)}, i * 1000)` 放入 Call Stack，瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 2 毫秒後，將 `() => {console.log(i)}` 放入 callback queue 排隊。
- 第四圈迴圈，此時 `i = 3`，i 小於五。
  - 將 `console.log('i: ' + i)`， 放入 Call Stack，執行後顯示 `i: 3`，將此層從 Call Stack 移除。
  - 將 `setTimeout(() => {console.log(i)}, i * 1000)` 放入 Call Stack，瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 3 毫秒後，將 `() => {console.log(i)}` 放入 callback queue 排隊。
- 第五圈迴圈，此時 `i = 4`，i 小於五。
  - 將 `console.log('i: ' + i)`， 放入 Call Stack，執行後顯示 `i: 4`，將此層從 Call Stack 移除。
  - 將 `setTimeout(() => {console.log(i)}, i * 1000)` 放入 Call Stack，瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 4 毫秒後，將 `() => {console.log(i)}` 放入 callback queue 排隊。
- 第六圈迴圈，此時 `i = 5`，i 不小於五，迴圈結束，將此層從 Call Stack 移除。

3. main thread 執行完，從 Call Stack 移除。
> event loop 發現 Call Stack 已清空，開始把 callback queue 的程式依序放到 Call Stack。
4. 第一圈迴圈的 `() => {console.log(i)}` 被放到 Call Stack，由於上一層作用域的 i 等於 5，程式執行後顯示 5，將此層從 Call Stack 移除。
5. 第二圈迴圈的 `() => {console.log(i)}` 被放到 Call Stack，由於上一層作用域的 i 等於 5，程式執行後顯示 5，將此層從 Call Stack 移除。
6. 第三圈迴圈的 `() => {console.log(i)}` 被放到 Call Stack，由於上一層作用域的 i 等於 5，程式執行後顯示 5，將此層從 Call Stack 移除。
7. 第四圈迴圈的 `() => {console.log(i)}` 被放到 Call Stack，由於上一層作用域的 i 等於 5，程式執行後顯示 5，將此層從 Call Stack 移除。
8. 第五圈迴圈的 `() => {console.log(i)}` 被放到 Call Stack，由於上一層作用域的 i 等於 5，程式執行後顯示 5，將此層從 Call Stack 移除。

