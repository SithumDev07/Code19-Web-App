const form = document.querySelector('form');
const firstName = document.querySelector('#firstName');
const lastName = document.querySelector('#lastName');
const address = document.querySelector('#address');
const DOB = document.querySelector('#DOB');
const submit = document.querySelector('#submit');
const signin = document.querySelector('#signin');

var date = new Date();
var currentDate = date.toISOString().substring(0,10);
//Minimum and maximum Age for employees
var maximumDate = date.getFullYear() - 16;
var minimumDate = date.getFullYear() - 55;


console.log(minimumDate)

document.getElementById('DOB').value = currentDate;


if(submit.addEventListener) {
    submit.addEventListener('click', returnToPrevious);
} else {
    submit.attachEvent('onclick', returnToPrevious);
}

function returnToPrevious (e) {
    e = e || window.event;

    if(!checkInputs()) {
        if(e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
    }

}


function checkInputs() {
    // e.preventDefault();
    //Getting all the values
    const firstNameValue = firstName.value.trim();
    const lastNameValue = lastName.value.trim();
    const addressValue = address.value.trim();
    var success = true;

    if(firstNameValue === '') {
        setError(firstName, 'First name is required');
        success =  false;
    } else {
        setSuccess(firstName);
    }

    if(lastNameValue === '') {
        setError(lastName, 'Last name is required');
        success =  false;
    } else {
        setSuccess(lastName);
    }

    if(addressValue === '') {
        setError(address, 'Address is required');
        success =  false;
    } else {
        setSuccess(address);
    }

    if(DOB.value === null) {
        setErrorDate(DOB, 'Please select your birthdate');
        success =  false;
    } else {
        setSuccessDate(DOB);
    }

    return success;

}

function setError(input, message) {
    const formControl = input.parentElement; //Parent of input
    const errorEl = formControl.querySelector('p');
    const errorIcon = formControl.querySelector('.fa-exclamation-circle');

    errorEl.innerText = message;
    errorEl.classList.remove('hidden');
    input.classList.add('error');
    errorIcon.style.visibility = 'visible';
}


function setErrorDate(input, message) {
    const formControl = input.parentElement; //Parent of input
    const errorEl = formControl.querySelector('p');

    errorEl.innerText = message;
    errorEl.classList.remove('hidden');
    input.classList.add('error');
}

function setSuccess (input) {
    const formControl = input.parentElement;

    const errorEl = formControl.querySelector('p');
    const errorIcon = formControl.querySelector('.fa-exclamation-circle');
    const successIcon = formControl.querySelector('.fa-check-circle');

    errorEl.classList.add('hidden');
    input.classList.add('success');
    input.classList.remove('error');
    errorIcon.style.visibility = 'hidden';
    successIcon.style.visibility = 'visible';
}


function setSuccessDate (input) {
    const formControl = input.parentElement;

    const errorEl = formControl.querySelector('p');

    errorEl.classList.add('hidden');
    input.classList.add('success');
    input.classList.remove('error');
}


//sds



function isValidDate(date)
{
    var matches = /^(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})$/.exec(date);
    if (matches == null) return false;
    var d = matches[2];
    var m = matches[1] - 1;
    var y = matches[3];
    var composedDate = new Date(y, m, d);
    return composedDate.getDate() == d &&
            composedDate.getMonth() == m &&
            composedDate.getFullYear() == y;
}

signin.addEventListener('click', () => {
    console.log(isValidDate(DOB.value));
    console.log(DOB.value);
})

// console.log(isValidDate(DOB.value));
// console.log(DOB.value);
// console.log(isValidDate('12/11/1961'));
// console.log(isValidDate('02-11-1961'));
// console.log(isValidDate('12/01/1961'));
// console.log(isValidDate('13-11-1961'));
// console.log(isValidDate('11-31-1961'));
// console.log(isValidDate('11-31-1061'));