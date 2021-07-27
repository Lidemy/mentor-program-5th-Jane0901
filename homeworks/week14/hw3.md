## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
域名系統（Domain Name System）負責將人們易讀的網域名稱（Domain Name）與機器讀取的 IP 位置做轉換。

Google 提供公開的 DNS，對它們自身的好處是方便收集大眾數據，能更精準的投放廣告。而對一般大眾來說，google 表示它們的 DNS 優勢有速度較快、安全性較高。

## 什麼是資料庫的 lock？為什麼我們需要 lock？
資料庫的 lock 可以根據不同需求，去對資料、資料表或資料庫做鎖定，被鎖定的目標須等待前面的操作完成後，才會執行下一個操作。

當多個 request 對同一筆資料進行操作時，可能會互相影響而造成錯誤，所以要設定 lock 以確保不同操作間不會互相影響。

## NoSQL 跟 SQL 的差別在哪裡？
它們的差別在於 NoSQL 是非關聯式資料庫，而 SQL 是關聯式資料庫。被稱作非關聯式資料庫的原因是資料庫沒有 Schema，會以 key-value 存進去，可想像成存 JSON 資料進 DB。且因為沒有 Schema，所以非關聯式資料庫無法像關聯式資料庫能 join table，此類型的資料庫通常用來存一些結構不固定的資料，如 log。

## 資料庫的 ACID 是什麼？
由於 transaction 對資料的操作同時牽扯到多個 query ，為了保證正確性，須符合四個特性（ACID），這類的情境包含轉帳、購物...等。
- 原子性（atomicity）：query 的執行結果只會全部失敗或全部成功，即使是中間的執行過程發生錯誤，也會回到 transaction 開始前的狀態。
- 一致性（consistency）：在 transaction 前後，資料庫的完整性不會被破壞。
- 隔離性（isolation）：資料庫允許多個 transaction 同時進行，但也確保 transaction 之間不會互相影響，所以不能同時改同一個值。
- 持久性（durability）：transaction 成功後，即使系統故障，寫入的資料也不會不見。
