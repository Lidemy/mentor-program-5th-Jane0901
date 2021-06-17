## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
- VARCHAR：可以指定儲存長度，索引速度比 TEXT 快，通常用在有字元限制、已知需求字元大小的狀況
- TEXT：無法指定儲存長度，索引速度比 VARCHAR 慢，通常用在不確定需求字元大小的狀況

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
- Cookie 是小型文字檔案，用來讓 Server 辨別 Client 的狀態
- Server 在 response 透過 header 中的 Set-Cookie 設定 Cookie，瀏覽器接收後便將 Cookie 內容儲存進去
- 瀏覽器根據儲存的 Cookie，在發 request 時會在 header 帶上對應的 Cookie 資料

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
- 輸入的內容如果是 HTML 語法會出錯
- 註冊時密碼沒有二次確認
- 無法編輯暱稱
- 無法編輯、刪除留言
