function capitalize(str) {
    if (str === '') return ' '
    return str[0].toUpperCase() + str.slice(1)
}

console.log(capitalize('hello'));