const priceFilter = (event) => { //this filter should be used with onkeypress event
  /*TODO maybe do the filtering onKeyup or input, it's easier to control, just update the result if it doesn't fit*/
  let charCode = (event.which) ? event.which : event.keyCode
  console.log(event)
  //allow only numeric, dot and certain function chars
  //(tab, enter, ctrl, arrows, shift)
  if (
    (charCode < 46 || charCode > 57) &&
    ![13, 8, 9, 16, 17].includes(charCode)
  ) {
    event.preventDefault()

    return false
  }

  //keypress event's value return the previous value
  let value = event.target.value;

  //this check is without fn chars
  if (
    charCode < 46 || charCode > 57
  ) {
    event.preventDefault()

    return false
  }
  //so concat the current pressed key with the prev value
  //if it is numeric and dot
  value += event.key

  console.log('newValue')
  console.log(value)

  //evaluate the whole value to ensure it's structure is:
  //1 ( any n )
  //12
  //12.3
  //12.34 ( only 2 decimal after dot )
  //0.22 ( only 1 trailing zero )
  if (!/^(0|[1-9]\d*)(\.\d{0,2})?$/.test(value)) {
    event.preventDefault()

    return false
  }

  return true
}

const integerFilter = (event) => {
  let charCode = (event.which) ? event.which : event.keyCode
  if (
    (charCode < 48 || charCode > 57)
  ) {
    event.preventDefault()

    return false
  }

  return true
}


export {
  integerFilter,
  priceFilter
}