const form = document.querySelector('form');
const mobile = document.querySelector('#mobile');
const landLine = document.querySelector('#landLine');
const position = document.querySelector('#position');
const shift = document.querySelector('#shift');
const submit = document.querySelector('#submit');
const signin = document.querySelector('#signin');
const agreement = document.querySelector('#agreement');


agreement.addEventListener('click', () => {
    submit.classList.toggle('disabled:opacity-40');
    submit.toggleAttribute('disabled');
})


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
    const mobileValue = mobile.value.trim();
    const landLineValue = landLine.value.trim();
    var success = true;

    if(mobileValue === '') {
        setError(mobile, 'Mobile number is required');
        success =  false;
    } else if(mobileValue.length != 10) {
        setError(mobile, 'Mobile number is invalid');
        success =  false;
    }else {
        setSuccess(mobile);
    }


    if(!(landLineValue === '') && landLineValue.length != 10) {
        setError(landLine, 'Landline number is invalid');
        success =  false;
    } else if(landLineValue === '') {

    } else {
        setSuccess(landLine);
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
