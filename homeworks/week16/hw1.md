**題目**
```javascript
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```

**答案**
```
1
3
5
2
4
```

**程式執行流程**
1. main thread 在 Call Stack 執行。
2. 將 `console.log(1)` 放入 Call Stack，執行後顯示 1，將此層從 Call Stack 移除。
3. 將 `setTimeout(() => {console.log(2)}, 0)` 放入 Call Stack，由於 `setTimeout` 屬於 Web API，於是瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 0 秒後，將 `() => {console.log(2)}` 放入 callback queue 排隊。
4. 將 `console.log(3)` 放入 Call Stack，執行後顯示 3，將此層從 Call Stack 移除。
5. 將 `setTimeout(() => {console.log(4)}, 0)` 放入 Call Stack，由於 `setTimeout` 屬於 Web API，於是瀏覽器開始計時，同時將此層從 Call Stack 移除。計時 0 秒後，將 `() => {console.log(4)}` 放入 callback queue 排隊。
6. 將 `console.log(5)` 放入 Call Stack，執行後顯示 5，將此層從 Call Stack 移除。
7. main thread 執行完，從 Call Stack 移除。

> event loop 發現 Call Stack 已清空，開始把 callback queue 的程式依序放到 Call Stack。

8. `() => {console.log(2)}` 被放到 Call Stack，執行後顯示 2，將此層從 Call Stack 移除。
9. `() => {console.log(4)}` 被放到 Call Stack，執行後顯示 4，將此層從 Call Stack 移除。
