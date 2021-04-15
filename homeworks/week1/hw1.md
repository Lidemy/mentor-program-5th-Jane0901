## 交作業流程

1. 新開一個 branch：`git branch week1`
2. 切換到該 branch：`git check out week1`
3. 寫作業
4. 如果有新增檔案，要加入版本控制：`git add .`
5. 想要提交改動後的檔案時，送出 commit：`git commit -am "hw1"`
6. 上傳到 Github：`git push origin week1`
7. 到 Github 自己的 repo 上按 Pull Request
8. 複製 PR 的網址，在學習系統貼上繳交

作業改完助教 merge 後：

1. 切換到 master：`git checkout master`
2. 將 Github 改動後的 master 拉下來：`git pull origin master`
3. 刪除已經 merge 的 branch：`git branch -d week1`
