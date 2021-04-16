## 請解釋後端與前端的差異。
前端指的是使用者瀏覽網頁時看到的部分，包含靜態 HTML、CSS 與動態 Javascript，而後端則是使用者看不到 server 在處理的部份。

## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
1. 瀏覽器藉由 DNS 伺服器了解 google 的 IP 位置
2. 瀏覽器送 request 到 IP 位置的 server
3. server 到資料庫搜尋關鍵字
4. 資料庫回傳資料給 server
5. server 回傳 response 給瀏覽器
6. 瀏覽器顯示回傳的資訊

## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
- `sudo`：認證用戶以取得權限
- `head -數字 檔名`：顯示文件最前面幾行
- `cal`：顯示日曆