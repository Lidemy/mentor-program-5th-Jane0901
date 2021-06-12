## 什麼是 Ajax？
非同步跟伺服器交換資料的 JavaScript，早期多用 XML 作為資料交換格式，目前則多是 JSON。其中非同步的意思是程式執行時，不會等待結果回傳，便直接執行後面程序，故非同步請求是指客戶端對 server 送出 request 後，不需等待結果，仍然可以持續處理其他事情，讓程式執行比較有效率

## 用 Ajax 與我們用表單送出資料的差別在哪？
用表單送出資料時，瀏覽器會自動渲染 response 的結果，故會換頁。而用 Ajax 送出資料時，Server 回傳的 response 會進一步給瀏覽器上的 JavaScript，並非瀏覽器本身，故瀏覽器不會自動渲染 response 的內容

## JSONP 是什麼？
透過 script 標籤不受同源限制的特性，以 javascript 拿到資料。另外，帶參數時只能用 GET 附加在網址上，沒辦法用 POST

## 要如何存取跨網域的 API？
使用 JSONP，或是用 Ajax 時 Server 在 Response 的 Header 加上 `Access-Control-Allow-Origin`

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為先前是從 node.js 發送 request，這週是從瀏覽器發送 request，而瀏覽器對於安全性有同源政策的限制

- 同源政策：發 request 的網站與要呼叫 API 的網站不同源時，瀏覽器雖然會幫忙發 Request，但是會把 Response 擋下來，且傳回錯誤、不讓 JavaScript 拿到資料
