function reverse(str) {
    var result = ''
    for (i = str.length; i >= 1; i--) {
        result += str[i - 1]
    }
    console.log(result)
}

reverse('hello');