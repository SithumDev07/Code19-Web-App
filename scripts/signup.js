const form = document.querySelector('form');
const username = document.querySelector('#username');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const confirmedPassword = document.querySelector('#confirmedPassword');
const submit = document.querySelector('#submit');
const restricted = document.querySelector('#restricted');

if(restricted !== null) {
    restricted.addEventListener('click', () => {
        document.querySelector('main').classList.remove('blur-error')
        document.querySelector('.restricted').classList.add('hidden')
        console.log('Working');
    })
}

console.log('Working');
focusEventListener(username);
focusEventListener(email);
focusEventListener(password);
focusEventListener(confirmedPassword);

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
    document.getElementById('alreadyTaken').classList.add('hidden');
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const confirmedPasswordValue = confirmedPassword.value.trim();
    var success = true;

    if(usernameValue === '') {
        
        setError(username, 'Username is required');
        success =  false;
    }  else if(validateSpecialCharacters(usernameValue)) {
        setError(username, 'Special Characters not allowed');
        success =  false;
    }else {
        setSuccess(username);
    }

    if(emailValue === '') {
        setError(email, 'Email is required');
        success =  false;
    } else if (!isEmail(emailValue)) {
        setError(email, 'Email is not valid');
        success =  false;
    } else {
        setSuccess(email);
    }

    if(passwordValue === '') {
        setError(password, 'Password is required');
        success =  false;
    } else if(passwordValue.length < 8) {
        setError(password, 'Password should contain atleast 8 characters');
        success =  false;
    } else {
        setSuccess(password);
    }

    if(confirmedPasswordValue === '') {
        setError(confirmedPassword, 'Please confirm your password');
        success =  false;
    }else if( passwordValue.length < 8 && confirmedPasswordValue.length < 8) {
        setError(confirmedPassword, 'Password should contain atleast 8 characters');
        success =  false;
    } else if (confirmedPasswordValue !== passwordValue) {
        setError(confirmedPassword, "Passwords don't match");
        success =  false;
    } else {
        setSuccess(confirmedPassword);
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

function setActive (input) {
    const formControl = input.parentElement;

    const errorEl = formControl.querySelector('p');
    const errorIcon = formControl.querySelector('.fa-exclamation-circle');
    const successIcon = formControl.querySelector('.fa-check-circle');

    errorEl.classList.add('hidden');
    input.classList.add('listening');
    input.classList.remove('error');
    errorIcon.style.visibility = 'hidden';
    successIcon.style.visibility = 'visible';
}


function isEmail (email) {
    // RegEx for test for a valid email
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

