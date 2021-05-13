## 請以自己的話解釋 API 是什麼
使用 API 就是一個可獲取資料的方式。資料供給方將願意公開的資料、取得方式放在 API 文件上，由於內容、規則是由供給方制定，所以需求方必須符合供給方的要求才能拿到資料，且資料內容也是以供給方有釋出的內容為限。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹
- 202 Accepted：伺服器已接受 request 但尚未處理，最後 request 不一定會被執行，並且可能在處理發生時被禁止。
- 304 Not Modified：代表客戶端此次其實不需要 request，因為之前 requeat 後已有緩存檔案，且此次要 return 的內容並未改變。
- 403 Forbidden：伺服器理解該 request，但客戶端沒有存取該資源的權限，故拒絕核准。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。
ＡLL: 一個有全部資料的網址

| 說明 | Method | path | 參數 | 範例 |
| --- | --- | --- | --- | --- |
| 回傳所有餐廳資料 | GET | /restaurants | _limit: 限制回傳資料數量 | /restaurants?_linmit=20
| 回傳單一餐廳資料 | GET | /restaurants/:id | 無 | /restaurants/5
| 刪除餐廳 | DELETE |/restaurants/:id | 無 | 無 | 
| 新增餐廳 | POST | /restaurants | name: 餐廳名稱 | 無
| 更改餐廳 | PATCH | /restaurants/:id | name: 餐廳名稱 | 無
