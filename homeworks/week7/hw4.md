## 什麼是 DOM？
把 HTML 上各個標籤定義成 Object，最終會形成一個樹狀結構，使 JavaScript 可以利用 DOM 拿到節點上的元素並加上事件處理程序，故 DOM 可視為瀏覽器上 JavaScript 與 HTML 的橋樑

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
事件傳遞的順序為捕獲階段、目標階段、冒泡階段。點擊某元素時，該點擊事件會從 window 往下傳到該元素，此過程即是捕獲階段，而點擊事件從元素回傳到 window 的過程則是冒泡階段

## 什麼是 event delegation，為什麼我們需要它？
事件代理機制，在父元素設定事件監聽，即可處理到所有子元素的事件。此做法比較有效率，而且可監聽到動態新增在底下的元素

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
- event.preventDefault()：阻止瀏覽器預設的行為，與事件傳遞無關，常用的時機為表單送出、按超連結
- event.stopPropagation()：中斷事件傳遞下去，會影響到後續傳遞過程的監聽事件
