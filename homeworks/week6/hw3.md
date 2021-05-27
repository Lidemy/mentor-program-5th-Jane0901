## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- `<select>`：下拉式選單，另外以 `<option>` 建立個別選項
- `<figure>`：可附標題的內容元素，經常與 `<figcaption>` 一起使用
- `<strong>`：表示內容的重要性，以粗體顯示

## 請問什麼是盒模型（box modal）
可以把每一個 html 的元素看成是一個盒子，其中包含 width、height、padding、border、margin。

調整 `box-sizing` 屬性可決定 box modal 的顯示模式：
- content-box：調整 border、paddong 時，因為 width、height 不變，故整個元素的大小會被改變
- border-box：調整 border、paddong 時，為了保持整個元素的大小不變，所以 width、height 會被自動調整

## 請問 display: inline, block 跟 inline-block 的差別是什麼？什麼時機點會用到？
- block：預設值，單一元素左右撐滿，各種屬性皆可正常調整，預設為此排列的元素有 div、h1、p
- inline：可多個元素在同一行，調整寬度、高度沒有作用，而上下邊距也不會影響到元素內容的位置，預設為此排列的元素有 span、a
- inline-block：自動縮放到內容範圍，且會待在同一行，對外像 inline 可併排，對內像 block 可調各種屬性，預設為此排列的元素有 button、input、select

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
| position| static | relative | absolute |fixed|
| -------- | -------- | -------- | -------- |-------- |
| 是否在排版系統內| 是 | 是 | 否 | 否 |
| 定位依據 | 無，預設狀態，不做其他排列 | 原始位置 | 上一層非 static 的容器  | 視窗原點 |

