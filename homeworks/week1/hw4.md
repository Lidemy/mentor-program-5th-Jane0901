## 跟你朋友介紹 Git
### Git 基本概念
git 版本控制可以紀錄下檔案的改動過程，所以可以清楚瞭解每個版本的差異，而且也可以把檔案回復成過去儲存過的版本。另外，因為可以開分支作業，所以它的優點還有方便多人協作。

### Git 基礎的使用
- `git init`：初始化，在該資料夾開啟 git 版本控制
- `git status`：查看 git 的狀態
```
untracked：不加入版本控制
staged：加入版本控制
```
- `git add`：將檔案寫入版本控制
  - `git rm --cached`：將檔案移除版本控制
  - `git add.`：將**所有**檔案加入版本控制
- `git commit`：新建一個版本
  - `git commit -m ''`：commit 時輸入版本敘述
  - `git commit -am ''`：同時 add 並 commit，但**無法包含新增的檔案**
  - `commit --amend`：修改 commit message

除了使用本機的 git 做版本控制外，可以進一步把檔案傳到類似雲端空間的 GitHub上，它可以完整儲存版本控制過程。從本地上傳到遠端的過程須要用`git push origin master`，從遠端下載到本地的過程則要用`git pull origin master`。