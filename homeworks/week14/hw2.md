雖然建議自己研究過後，遇到卡關再找學長姐的文章參考會比較好，但是我對於部署有著莫名的恐懼，也不想花太多時間在這個過程上，所以選擇直接按照文章的指示去做。
- 申請主機、安裝與設定遠端環境：[部署 AWS EC2 遠端主機 + Ubuntu LAMP 環境 + phpmyadmin](https://github.com/Lidemy/mentor-program-2nd-yuchun33/issues/15)
- 將檔案上傳到主機：[[AWS] 透過 FileZilla 使用 key-pairs 登入 AWS EC2 存取檔案](http://www.jysblog.com/coding/web/aws-透過-filezilla-使用-key-pairs-登入-aws-ec2-存取檔案/)
- 申請自己的網域：[網域 Domain 的申請](https://ccckmit.medium.com/網域-domain-的申請-77f08e0b7af7)、[【免費網址】Freenom – 快速申請自己的網域名稱](https://7--8.com/freenom/)

過程中，遇到 phpMyAdmin 登入不了的問題，當時知道隔兩天會沒有時間學習，但又不想把問題擱置兩天後才處理，所以第一時間 google 了錯誤訊息，不過沒有理解造成錯誤訊息的原因，以及為何後續要做那些設定，就先直接照著做，接著又出現了其他的錯誤訊息，然後一直沒處理好，最後決定先關掉這台主機，兩天後從頭來過。

第二次的部署過程非常順利，原本預計如果碰到先前的錯誤，會再好好理解並處理，不過就沒再遇到了。

- 部署結果：
  - 主機：AWS
  - 作業系統：Ubuntu Server 20.04
  - ip 位置：3.19.255.108
  - 域名：jane.ml

以下記錄在過程中不瞭解，另外去查資料的內容。

- #### 什麼是 `ssh` ，使用它可以遠端連線？
從文章 [[Security] 你該知道所有關於 SSH 的那些事](https://jennycodes.me/posts/security-ssh) 中，瞭解了它是一個連線加密機制，並且是使用 Public Key Crytography 幫資料加密。
- #### 連線的結果是 `WARNING: UNPROTECTED PRIVATE KEY FILE!`
從文章 [解決 WARNING: UNPROTECTED PRIVATE KEY FILE!](https://www.opencli.com/linux/fix-warning-unprotected-private-key-file) 中，知道這個問題是 key 的權限過於寬鬆，所以要使用指令 `chmod 600` 去改變權限。而關於檔案權限的說明，還有從 [鳥哥的 Linux 私房菜-第五章、Linux 的檔案權限與目錄配置](http://linux.vbird.org/linux_basic/0210filepermission.php) 去學習。
- #### 無法從瀏覽器開啟 phpMyAdmin
按照 [Day 03 : 環境架設 part II -- MySQL & phpMyAdmin](https://ithelp.ithome.com.tw/articles/10216815) 文章中設定 configuration file 的步驟得以解決。
- #### 使用 phpMyAdmin 登入 MySQL ，先後出現了錯誤訊息 `mysqli_real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES)`，以及 `mysqli_real_connect(): (HY000/2002): No such file or directory`
當下沒有認真記錄到細節以及過程，只記得有依照兩篇 stackoverflow 的問答試圖解決，分別為 [phpMyAdmin access denied for user 'root'@'localhost' (using password: NO)
Ask Question](https://stackoverflow.com/questions/45111527/phpmyadmin-access-denied-for-user-rootlocalhost-using-password-no) 與 [Warning: mysqli_connect(): (HY000/2002): No such file or directory
](https://stackoverflow.com/questions/20073168/warning-mysqli-connect-hy000-2002-no-such-file-or-directory)。
