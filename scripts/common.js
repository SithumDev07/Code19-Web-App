
// State Selector for only run some functions only on isRegister.js
let isRegister = true;



// Setting the focus status of each input fields
function setTrueOrFalse(value, variable) {
    if(value === true || value === false) {
        switch(variable) {
            case 'username':
                isFocusedUsername = value;
                break;
            case 'firstname':
                isFocusedFirstname = value;
                break;
            case 'lastname':
                isFocusedLastname = value;
                break;
            case 'phone':
                isFocusedPhone = value;
                break;
            case 'address':
                isFocusedAddress = value;
                break;
            case 'password':
                isFocusedPassword = value;
                break;
            case 'reentered':
                isFocusedReentered = value;
                break;
            case 'initials':
                isFocusedInitials = value;
                break;
            case 'fullname':
                isFocusedFullName = value;
                break;
            case 'donarname':
                isFocusedDonarName = value;
                break;
            default:
                throw new Error(`Invalid varible name: ${variable}`);
        }
    } else {
        throw new Error(`Invalid Value, Value must be true or false`);
    }
    
}

// Getting the current focus status true = focused and false = blurred
function getTrueOrFalse(container) {
    switch(container) {
        case 'username':
            return isFocusedUsername;
        case 'firstname':
            return isFocusedFirstname;
        case 'lastname':
            return isFocusedLastname;
        case 'phone':
            return isFocusedPhone;
        case 'address':
            return isFocusedAddress;
        case 'password':
            return isFocusedPassword;
        case 'reentered':
            return isFocusedReentered;
        case 'initials':
            return isFocusedInitials;
        case 'fullname':
            return isFocusedFullName;
        case 'donarname':
            return isFocusedDonarName;
        default:
            throw new Error(`Invalid varible name: ${container}`);
    }
}


// Event lisener for focus, blur and keyup
function focusEventListener(Element, container = undefined, variable = undefined) {
    // Element.addEventListener('focus', () => {
    //   document.querySelector(`.floating-${container}`).classList.add('active-lable');
    //   document.querySelector(`.${container}-wrapper`).classList.remove('border-gray-300');
    //   document.querySelector(`.${container}-wrapper`).classList.add('border-yellow');
    //   setTrueOrFalse(true, container);
    // })
    // Element.addEventListener('blur', () => {
    //   if(Element.value == '')
    //   document.querySelector(`.floating-${container}`).classList.remove('active-lable');
    //   document.querySelector(`.${container}-wrapper`).classList.add('border-gray-300');
    //   document.querySelector(`.${container}-wrapper`).classList.remove('border-yellow');
    //   setTrueOrFalse(false, container);
    // })
    Element.addEventListener('keyup', () => {
        // if(getTrueOrFalse(container))
        // validate(Element, container);
        // console.log(variable);
        checkInputs();
        console.log('Triggering');
    });
}

function realtimeValidate() {

}

//Labour, Staff, Child Event Lisener
function EventListener(Element, container) {
    Element.addEventListener('keyup', () => {
        // console.log(getTrueOrFalse(container));
        validateForms(Element, container);
        // console.log(variable);
    });
}

// Specific Error setter for lables borders
function setErros(wrapper, errorEl, specificError = '') {
    wrapper.classList.add('border-red');
    wrapper.classList.remove('border-yellow');
    errorEl.classList.remove('hidden');

    if(specificError !== '') {
        errorEl.innerHTML = specificError;
    }
}

// If error indicators are added then set them to default status
function setDefault(wrapper, errorEl) {
    // console.log(errorEl, wrapper);
    wrapper.classList.remove('border-red');
    wrapper.classList.add('border-yellow');
    errorEl.classList.add('hidden');
}

// Special Character Validator
function validateSpecialCharacters(input) {
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    return format.test(input) ? true : false;
}

function isValidPhoneNumber(input) {
    // var format = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    var format = /^(0|[+94]{3})?[7-9][0-9]{9}$/;;
    return format.test(input) ? true : false;
}

//Main Validatot function
function validate(input, container) {
    // console.log(container);
    if(!(container == 'password' || container == 'reentered' || container == 'address' || container == 'phone')) {
        if(validateSpecialCharacters(input.value)) {
            setErros(
                document.querySelector(`.${container}-wrapper`),
                document.querySelector(`.error-message-${container}`),
                'Special Characters not allowed!'
            );
        } else {
            setDefault(
                document.querySelector(`.${container}-wrapper`),
                document.querySelector(`.error-message-${container}`)
            );
        }
    } 
    else {
        setDefault(
            document.querySelector(`.${container}-wrapper`),
            document.querySelector(`.error-message-${container}`)

            
        );
    }

    if(isRegister) {
        if(container == 'username') {
            document.querySelector('.already-taken').classList.add('hidden');
        }
    }
    
}



function validateForms(input, container) {
    // console.log(input);
    if(input.id !== 'staffEmail') {
        if(validateSpecialCharacters(input.value)) {
            input.classList.remove('border-gray-400')
            input.classList.remove('border-green-500')
            input.classList.add('border-red-500')
        } else {
            input.classList.remove('border-red-500')
            input.classList.add('border-gray-400')
        }
    } else {

        if(isValidEmail(input)) {
            input.classList.remove('border-red-500')
            input.classList.add('border-green-500')
            // console.log('Valid email');
        } else {
            input.classList.remove('border-gray-400')
            input.classList.remove('border-green-500')
            input.classList.add('border-red-500')
            // console.log('invalid email');
        }
    }
}

// function isValidEmail(input) {
//     var regEmail=/^([a-zA-Z0-9\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$/;
//     if(!regEmail.test(input.value)){
//         return false;
//     } else {
//         return true;
//     }
// }

// Fields are empty validator
function emptyChecker(Element) {
    return Element.value === '' ? true : false;
    
}

//Two fileds are identical validator
function isMatch(first, second) {
    return first == second ? true : false;
}

function isValidExtention(file) {

    var allowedFiles = [".jpg", ".jpeg", ".png", "png"];
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
    if (!regex.test(file.value.toLowerCase())) {
        alert("Please upload files having extensions: " + allowedFiles.join(', ') + " only.");
        return false;
    }
    return true;
}

function isValidImageSize(file) {
    if (file.files.length > 0) {
        for (const i = 0; i <= file.files.length - 1; i++) {

            const fsize = file.files.item(i).size;
            const newFile = Math.round((fsize / 1024));
            // The size of the file.
            if (newFile >= 3072) {
                alert(
                  "Profile Picture is too large, please select a file less than 3MB");
                  return false;
            } 
            // else if (newFile < 1024) {
            //     alert(
            //       "File is too small, please select a file greater than 1mb");
            //       return false;
            // } 

            return true;
        }
    }
  }

  function isValidPhonenumber(input)
{
    let phone = /^[\+]?[(]?[0-9]{0,2}[)]?[-\s\.]?[0-9]{2,3}[-\s\.]?[0-9]{3,4}?[0-9]{3,4}$/im;;
    if(input.value.match(phone)){
      return false;
    }
    else {
        return true;
    }
}