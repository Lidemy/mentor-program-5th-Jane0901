## 六到十週心得與解題心得
### 六到十週
一開始覺得切版很麻煩，不過隨著課程前進，透過每個作業的練習，確實有感受到自己進步，在切出理想中的畫面後很有成就感。

使用 JavaScript 做事件處理，相對後面兩週的課程來說變化較小，做完作業也有熟悉許多，不過經歷了這兩個禮拜的課程後又有點生疏，需要再複習一下。

JavaScript 跟後端溝通以及 PHP、SQL 是我覺得最難掌握的部分，因為錯誤處理、資安問題很重要，但是需要花費非常大的心力，才能做出稍微完整的處理與防範，然而背後可能還是有自己沒設想到的狀況。

目前的學習是以跟上進度為主，所以有些作業一卡住就會找示範影片看，甚至第九週的留言板是直接跟著影片的步驟做出來。可以理解每一個寫出來的程式內容，但要自己寫出完整的程式，總覺得還有一大段距離。目前無法不看任何筆記、影片就完成作業，希望未來兩週能進步到只看自己筆記，完成作業後再看示範影片。

### 綜合能力測驗
一開始打開 deve tool 看到註解起來的 PHP 原始碼後，以為是要把註解取消掉，改成 `<?php ?>` 的形式，發現沒有反應後才仔細讀內容，帶上正確的 querystring。中間的步驟沒有問題，但是最後一直不知道要怎麼設定遺漏的變數，透過 google 查到先前的解題心得，才知道要在 console 做設定，以及將亂碼透過 SHA-1 轉換成正確數字。

### r3:0 異世界網站挑戰
卡關的地方是從學長姐破關心得學習方法，下面紀錄卡住的關卡
- 第一關：知道要把 2 進位轉成 18 進位的文字，直覺是去找別人製作好的轉換進位網站，不過沒有自己找到，是從學長姐的分享中找到[任意進制轉換網站](http://www.kwuntung.net/hkunit/base/base.php)。雖然成功破關，但發現應該要用 `parseInt(string, radix)` 比較好，於是又去研究如何使用，瞭解了它可以把不同進位制的字串轉成 10 進位的數字，然後再用 `intValue.toString(radix)` 將數字轉成特定的進位制
- 第五關：自己沒有發現是被跳轉到第六關失敗的地方，從學長姐破關心得知道按下 esc 能凍結頁面，不過看到老師說真正的解法是看每個 request 發生什麼事情，或是用瀏覽器以外的方式去發 request。於是從 request 中發現第五關的 js 是 `window.location='./lv6.php?token=fail'` ，然後再用 cmd curl 網頁
- 第六關：又沒想到可以從 console 輸入 window 看內容
- 第九關：經過查詢後瞭解了 php ord 函數，不過要推導找出符合條件的 token 時，頭腦還是卡住
- 第十關：原本以為要 POST 東西，後來知道是同源政策導致 api 串接失敗後，複習用 node.js 發 request
- 第十三關：知道要拿不同數字帶入 tocken 去看 request 的反應時間後，原本只有加一個數字去測試，發現速度差異不大，後來改成四個同樣數字的 token 去測試，才發現了明顯差異
