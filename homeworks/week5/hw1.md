## 前四週心得
前四週中有兩週的作業是星期一才交，大致還算有跟上進度，但是挑戰題幾乎都沒做，還是感覺學習上有些落後，雖然現在沒有給自己太大的壓力，但想到時間越久差距越大的結果，就又常常突然地擔心起來。

第一週的課程內容偏少，而且原先就大概瞭解版本控制，所以覺得是個不錯的學習開頭，也有時間慢慢建立自己的學習流程。第二、三週的內容差不多，不過第三週因為學習時間比較少，加上自己卡關的停損點沒設好，所以進度稍微落後。第四週的 API 對我來說完全陌生，雖然現在已經瞭解課程中有介紹的基礎，但總覺得使用方式或限制很多樣，而且英文差對於看 API 文件或各種學習資源有些障礙，害怕之後自己的解決問題能力不足。

我覺得這個課程對我來說最大的好處，就是有跟自己學習進度相近的同學，除了發現學習挫折跟大家差不多時比較安慰外，常常同學分享的額外補充資料都很受用，還有直播時透過同學發問進而發現自己的盲點，就算目前沒認識到人，也依然有一起努力的感覺。

寫出來的前四週心得看起來好像是負面情緒居多，但其實實際上當下也沒這麼焦慮，還算是學習的很開心且滿足，只是同時會擔心著未來未知的挑戰。

## 解題心得
### Lidemy HTTP Challenge
使用 JS 的 request 完成遊戲，因為當下沒有同時紀錄，而且又過了好幾天，所以其實有點忘了完整的解題心得～只記得在 13 關卡最久，最後還是用 `X-Forwarded-For` 過關，原本打算用 curl 再挑戰一次，但眼看要進入第六週，就還是先以該週進度為主。

### LIOJ 題目
- 不合群的人（1016）
```javascript=
function solve(lines) {
  const n = lines[0]
  const data = []
  for (i = 1; i <= n; i++){
    data.push(lines[i])
  }
  whoIsDifferent(data)
}

function whoIsDifferent(arr) {
  let A = 0
  let B = 0
  for (i = 0; i < arr.length; i++) {
    if (arr[i] === 'A') {
      A += 1
    } else{
      B += 1
    }
  }
  if (A === B | A === 0 | B === 0) {
    console.log('PEACE')
  } else if (A > B) {
    for (j = 0; j < arr.length; j++) {
      if (arr[j] === 'B') console.log(j + 1)
    }
  } else {
    for (k = 0; k < arr.length; k++) {
      if (arr[k] === 'A') console.log(k + 1)
    }
  }
}

```
雖然可以直覺的寫出解法，但是覺得程式有些冗長，卻又不知從何修改。原本有想到聯誼順序比大小時，如果比小可以把 AB 對調的方法，可是在這題因為要回傳該值在陣列的位置，需要直接用 AB 字串做判斷，所以嘗試了之後發現沒有比較簡潔，然後就想不到其他可以改進的方法了。

- 貪婪的小偷（1017）
```javascript=
function solve(lines) {
  const c = Number(lines[0])
  const data = []
  for (let i = 2; i < lines.length; i++) {
    data.push(Number(lines[i]))
  }
  const n = data.length
  countValue(c, n, data)
}

function countValue(limit, total, arr) {
  let result = 0
  arr.sort(function(a, b) {
    return b - a
  })
  if (limit < total) {
    for (let i = 0; i <= limit - 1; i++) {
      result += arr[i]
    }
  } else {
    for (let i = 0; i < total; i++) {
      result += arr[i]
    }
  }
  console.log(result)
}

```
原本是用土法煉鋼的方法想要排序陣列，但卡了一段時間都得不到 AC，最後是翻了之前做的筆記直接用內建函式 `arr.sort` 完成，不過也會再找時間看「一起用 JavaScript 來複習經典排序法吧！」這篇文章。

- 大平台（1018）
```javascript=
function solve(lines) {
  const data = lines[1].split(' ')
  const [start, end] = [Number(data[0]), Number(data[data.length-1])]
  let result = 0
  for (let i = start; i <= end; i++) {
    let temp = 0
    for (let j = 0; j < data.length; j++) {
      if (data[j] == i) temp += 1
    }
    if (temp > result) result = temp
  }
  console.log(result)
}

```
忘記之前在做哪一題的時候就有類似解法，所以沒什麼卡住就寫出來。雖然判斷式應該用三個等號比較好，但有點懶得轉成數字型態，於是就用了兩個等號做判斷。
