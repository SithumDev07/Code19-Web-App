var date = new Date();
var currentDate = date.toISOString().substring(0,10);
var maximumDate = date.getFullYear() - 16;
var minimumDate = date.getFullYear() - 55;

var newDate = currentDate.replace(date.getFullYear(), maximumDate);

const recuitEmployee = document.querySelector('#recuitEmployee');
// let statusOriginal = true;
let toggleText = true;

// recuitEmployee.addEventListener('click', () => {
    
//     document.querySelector('.transformin-icon').classList.toggle('translate-icon');
//     if(toggleText) {
//         document.querySelector('.change-text-crew').innerHTML = "Cancel";
//     } else {
//         document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
//     }
//     toggleText = !toggleText;
//     document.querySelector('.add-crew-form').classList.toggle('hidden');
//     document.querySelector('.add-crew-form').classList.toggle('flex');
//     document.querySelector('.crew-form-container').classList.toggle('hidden');
//     document.querySelector('.crew-form-container').classList.toggle('block');
//     console.log('Working');
// })








const crewUploadProfile = document.querySelector('#crewUploadProfile')
const CrewImageContainer = document.querySelector('.CrewImageContainer')

function setErroOnCrewImage(error) {
    if(error) {
        CrewImageContainer.classList.remove('border-2')
        CrewImageContainer.classList.add('border-4')
        CrewImageContainer.classList.remove('border-blue-600')
        CrewImageContainer.classList.add('border-red-500')
    } else {

    }
}

function setErrorOnInputs(ele, error){
    if(error) {
        ele.classList.add('border-red-500')
        ele.classList.remove('border-green-500')
    } else {
        ele.classList.add('border-green-500')
        ele.classList.remove('border-red-500')
    }
}



function SalaryNDateInputListener(ele) {
    ele.addEventListener('keyup', () => {
        console.log('Still');
        if(ele.value <= 0 || ele.value.length === 0) {
            setErrorOnInputs(ele,true)
        }else if(ele.value === 0) {
            setErrorOnInputs(ele,true)
        }else if(ele.id === 'crewPayDate' && ele.value > 31) {
            setErrorOnInputs(ele,true)
        }else {
            setErrorOnInputs(ele,false)
        }
    })
}

function ListenOnInputChanges(ele) {
        ele.addEventListener('keyup', () => {
            console.log(ele.value);
            if(ele.id !== 'crewEmail' && ele.id !== 'crewLandLine' && ele.value.length === 0) {
                setErrorOnInputs(ele,true)
            }else if(ele.id === 'crewName' && validateSpecialCharacters(ele.value)) {
                setErrorOnInputs(ele,true)
            }else if(ele.id === 'crewEmail' && ele.value.length === 0) {
                setErrorOnInputs(ele,false)
            } else if(ele.id === 'crewLandLine' && ele.value.length === 0) {
                setErrorOnInputs(ele,false)
            }else if(ele.id === 'crewEmail' && !isEmail(ele.value)) {
                    setErrorOnInputs(ele,true)
            }else if(ele.id === 'crewPersonalNumber' && isValidPhonenumber(ele)) {
                setErrorOnInputs(ele,true)
            }else if(ele.id === 'crewLandLine' && isValidPhonenumber(ele)) {
                setErrorOnInputs(ele,true)
            }else {
                setErrorOnInputs(ele,false)
            }
        })
}

function validateCrewForms(name, email, address, personalNumber, salary, payDate, landLine, insert, crewProfilePic) {
    let success = true;
    
    if(insert){
        if(crewProfilePic.files.length === 0) {
            setErroOnCrewImage(true)
            success = false;
        } else {
            if(!isValidExtention(crewProfilePic)) {
                setErroOnCrewImage(true)
                success = false;
            }
        
            if(!isValidImageSize(crewProfilePic)) {
                setErroOnCrewImage(true)
                success=false;
            }
        }
    }

    if(name.length === 0) {
        setErrorOnInputs(document.querySelector('#crewName'),true)
        success = false;
    }else if(validateSpecialCharacters(name)) {
        setErrorOnInputs(document.querySelector('#crewName'),true)
        success=false;
    }

    if(email.length !== 0) {
        if(!isEmail(email)) {
            setErrorOnInputs(document.querySelector('#crewEmail'),true)
            success = false;
        }
    }

    if(address.length === 0) {
        setErrorOnInputs(document.querySelector('#crewAddress'),true)
        success = false;
    }

    if(personalNumber.length === 0) {
        setErrorOnInputs(document.querySelector('#crewPersonalNumber'),true)
        success = false;
    } else if(isValidPhonenumber(document.querySelector('#crewPersonalNumber'))) {
        setErrorOnInputs(document.querySelector('#crewPersonalNumber'),true)
        success = false;
    }
    
    if(landLine.length !== 0) {
        if(isValidPhonenumber(document.querySelector('#crewLandLine'))) {
            setErrorOnInputs(document.querySelector('#crewLandLine'),true)
            success = false;
        }
    }

    if(salary.length === 0) {
        setErrorOnInputs(document.querySelector('#crewSalary'),true)
        success = false;
    } else if(salary <= 0) {
        setErrorOnInputs(document.querySelector('#crewSalary'),true)
        success = false;
    }

    console.log(salary);
    console.log(payDate);

    if(payDate.length === 0) {
        setErrorOnInputs(document.querySelector('#crewPayDate'),true)
        success = false;
    }else if(payDate > 31 || payDate <= 0) {
        success = false;
    }

    if(success){

    }

    return success;
}

function isEmail (email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

