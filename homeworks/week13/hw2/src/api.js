import $ from 'jquery'

export function getCommentsAPI(baseUrl, siteKey, before, cb) {
  let url = `${baseUrl}/api_comments.php?site_key=${siteKey}`
  if (before) {
    url += `&before=${before}`
  }
  $.ajax({
    url
  }).done((data) => {
    cb(data)
  })
}

export function addCommentsAPI(baseUrl, siteKey, data, cb) {
  $.ajax({
    type: 'POST',
    url: `${baseUrl}/api_add_comments.php?site_key=${siteKey}}`,
    data
  }).done((data) => {
    cb(data)
  })
}
