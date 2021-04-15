## 教你朋友 CLI
### 什麼是 command line？
一般大家用滑鼠操作視覺化介面的狀況是圖形使用者介面（Graphical User Interface，GUI），而 command line 則是其對比方式，為使用者**用下指令的方式操作電腦**。

### 如何使用 command line？
首先做環境設置，如果電腦為 Mac，可叫出 terminal 或是下載 iTerm2，而 Windows 的電腦則是可安裝 Git 後開啟 git-bash 或是安裝 Cmder。

基礎指令：
- `pwd`：印出所在位置
- `ls`：印出現在資料夾底下檔案，加上`-代號`顯示檔案資訊
- `cd`：切換資料夾
  - `..`：上一層資料夾
  - `~`：/Users/nanme
  - `/`：root（根目錄）
- `man`：使用說明書
  - `q`：離開畫面
- `clear`：畫面清空

檔案操作相關指令：
- `touch`：建立檔案或是更改最後修改時間
- `rm`：刪除檔案
  - `rmdir` `rm -r`：刪除資料夾
- `mkdir`：新增資料夾
- `mv`：移動檔案或改名
  - `mv 檔名 ..`：將檔案移回上一層
- `cp`：複製檔案
  - `cp -r`：複製資料夾
- `cat`：顯示檔案內容
- `less`：分頁式顯示檔案內容

其他指令：
- `grep`：抓取關鍵字
- `wget`：下載檔案
- `curl`：送出 request
- `nslookup`：查看網頁的 DNS Server
- `date`：印出現在的時間
- `top`：印出所有 processes
- `echo`：印出字串

### 如何用 command line 建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案？
1. 建立一個叫做 wifi 的資料夾：`mkdir wifi`
2. 進到 wifi 資料夾中：`cd wifi`
3. 建立一個叫 afu.js 的檔案：`touch afu.js`