## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
- 雜湊：將無限輸入內容對應到有限輸出內容的函式，由於輸出有限，所以結果有機率產生碰撞，且無法從輸出內容反推輸入內容
- 加密：輸入內容經過 key 對應到唯一輸出內容，而輸出內容可透過 key 解密還原輸入內容
- 如果密碼是存明文，駭客只要駭進資料庫便可知道所有使用者的密碼，造成密碼外洩。若密碼經過雜湊，儘管雜湊後的值被駭客知道，也很難推導出真實密碼

## `include`、`require`、`include_once`、`require_once` 的差別
- `include`、`include_once` 在程式執行有錯時，會顯示錯誤訊息並停止執行，另外它們的差別為 `include_once` 會避免檔案重複引入
- `require`、`require_once`：程式執行有錯時，會顯示警告訊息但繼續執行，另外它們的差別為 `require_once` 會避免檔案重複引入

## 請說明 SQL Injection 的攻擊原理以及防範方法
- 攻擊原理：輸入的東西使 SQL query 是以攻擊者的命令去執行，可盜取資料、刪除表單...等
- 防範方法：使用 SQL 內建的 prepare statement 後，再執行 SQL query

##  請說明 XSS 的攻擊原理以及防範方法
- 攻擊原理：輸入的東西被當成程式碼，駭客便可執行 javascript 將訪客導去釣魚網站，或是偷用戶 cookie ...等
- 防範方法：將所有可輸入的內容在網頁輸出時確實轉成純文字，php 的函數 `htmlspecialchars()` 有此功能

## 請說明 CSRF 的攻擊原理以及防範方法
- 攻擊原理：攻擊者在 A 網站中藏一些操作，當使用者在 B 網站為登入裝態下，觸發了 A 網站的操作後，便發送攻擊者設定的 request 到 B 網站 ，由於瀏覽器自動帶上使用者的 cookie，後端以為是使用者本人，進而成功得到攻擊者要的結果
- 防範方法：
  - 檢查 referer，確認是否為合法的 domain
  - 加上圖形驗證、簡訊驗證
  - 在 form 放上一個隨機且唯一的 csrftoken，csrftoken 由 server 產生並存在 server 的 session 中，表單送出後 server 會比對 csrftoken 的內容
  - 在 form 放上一個隨機且唯一的 csrftoken，csrftoken 由 server 產生，另外讓 client side 設定一個名叫 csrftoken 的 cookie，其值相同，表單送出後 server 會比對 csrftoken 的內容
