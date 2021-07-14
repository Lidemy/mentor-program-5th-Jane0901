## Webpack 是做什麼用的？可以不用它嗎？
webpack 是模組整合工具，將模組全部包在一起，做一些轉換，以方便在瀏覽器上使用。且除了打包 javascript 的模組外，還進一步擴展到可以打包 css、scss、png...等檔案。雖然現在 javascript 已經有原生的 ES Modules 規範可以使用，但目前還是有瀏覽器不支援這種用法，所以如果不使用 Webpack 打包 javascript 模組，依然要找其他的模組化規範去使用。

## gulp 跟 webpack 有什麼不一樣？
Gulp 是 task 管理工具，可以設定任何自己需要的 task 內容，但是無法做到打包模組這件事。相對來說，使用 Webpack 的目的為打包模組，但無法設定任意的 task 內容。
兩個工具容易被混淆，是因為 Webpack 在打包模組的過程中，可以做到特定的 task 內容，像是用 Babel 將 ES6 編譯成 ES5 、將 SASS 編譯成 CSS...等。

## CSS Selector 權重的計算方式為何？
權重計算的等級由大到小為以下排名：
1. id：1-0-0
2. class：0-1-0
3. element：0-0-1

以高等的權重數字優先，且不論低等的權重數字多少，都無法超越高等的權重。

另外， !important 和 inline style 不參與權重計算，但 inline style 會永遠覆寫 stylesheets 當中的樣式，所以可以解釋成它的權重大於 id。而對於被註記 !important 的樣式，瀏覽器連權重都不計算，會直接套用，所以可以解釋成它的權重大於 inline style。

完整的優先順序排名：
1. !important
2. inline style
3. id：1-0-0
4. class：0-1-0
5. element：0-0-1


參考資料：[CSS Specificity / 權重](https://ithelp.ithome.com.tw/articles/10240444)
