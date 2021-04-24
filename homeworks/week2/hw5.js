function join(arr, concatStr) {
    var result = ''
    var j = 0
    for (i = 1; i <= arr.length * 2 - 1; i++) {
        if (i % 2 === 0) {
            result += concatStr
        } else {
            result += arr[j]
            j++
        }
    }
    return result
}

function repeat(str, times) {
    var result = ''
    for (i = 1; i <= times; i++) {
        result += str
    }
    return result
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));