var date = new Date();
var currentDate = date.toISOString().substring(0,10);
var maximumDate = date.getFullYear() - 16;
var minimumDate = date.getFullYear() - 55;

var newDate = currentDate.replace(date.getFullYear(), maximumDate);

const recuitEmployee = document.querySelector('#recuitEmployee');
// let statusOriginal = true;
let toggleText = true;







const crewUploadProfile = document.querySelector('#crewUploadProfile')
const CrewImageContainer = document.querySelector('.CrewImageContainer')

function setErroOnCrewImage(error, container) {
    if(error) {
        container.classList.remove('border-2')
        container.classList.add('border-4')
        container.classList.remove('border-blue-600')
        container.classList.add('border-red-500')
    } else {

    }
}

function setErrorOnInputs(ele, error){
    if(error) {
        // console.log(ele.classList);
        ele.classList.add('border-red-500')
        ele.classList.remove('border-green-500')
    } else {
        // console.log(ele.classList);
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

function ListenOnInputChanges(ele, specificInput) {
        ele.addEventListener('keyup', () => {
            console.log(ele.value);
            // console.log(ele.id, '  ', specificInput);
            if(ele.id !== `${specificInput}Email` && ele.id !== `${specificInput}LandLine` && ele.value.length === 0) {
                setErrorOnInputs(ele,true)
            }else if(ele.id === `${specificInput}Name` && validateSpecialCharacters(ele.value)) {
                setErrorOnInputs(ele,true)
            }else if(ele.id === `${specificInput}Email` && ele.value.length === 0) {
                setErrorOnInputs(ele,false)
            } else if(ele.id === `${specificInput}LandLine` && ele.value.length === 0) {
                setErrorOnInputs(ele,false)
            }else if(ele.id === `${specificInput}Email` && !isEmail(ele.value)) {
                    setErrorOnInputs(ele,true)
            }else if(ele.id === `${specificInput}PersonalNumber` && isValidPhonenumber(ele)) {
                setErrorOnInputs(ele,true)
            }else if(ele.id === `${specificInput}LandLine` && isValidPhonenumber(ele)) {
                setErrorOnInputs(ele,true)
            }else {
                setErrorOnInputs(ele,false)
            }
        })
}

function validateCrewForms(name, email, address, personalNumber, salary = undefined, payDate = undefined, landLine, insert, crewProfilePic, imageContainer = undefined, type = undefined) {
    let success = true;
    console.log(personalNumber);
    
    if(insert){
        if(crewProfilePic.files.length === 0) {
            setErroOnCrewImage(true, imageContainer)
            success = false;
        } else {
            if(!isValidExtention(crewProfilePic)) {
                setErroOnCrewImage(true, imageContainer)
                success = false;
            }
        
            if(!isValidImageSize(crewProfilePic)) {
                setErroOnCrewImage(true, imageContainer)
                success=false;
            }
        }
    }

    if(name.length === 0) {
        setErrorOnInputs(document.querySelector(`#${type}Name`),true)
        success = false;
    }else if(validateSpecialCharacters(name)) {
        setErrorOnInputs(document.querySelector(`#crewName`),true)
        success=false;
    }

    if(email.length !== 0) {
        if(!isEmail(email)) {
            setErrorOnInputs(document.querySelector(`#${type}Email`),true)
            success = false;
        }
    }

    if(address.length === 0) {
        setErrorOnInputs(document.querySelector(`#${type}Address`),true)
        success = false;
    }

    if(personalNumber.length === 0) {
        setErrorOnInputs(document.querySelector(`#${type}PersonalNumber`),true)
        success = false;
    // } else if(isValidPhonenumber(document.querySelector(`#${type}PersonalNumber`))) {
    } else if(isValidPhonenumberCrew(personalNumber)) {
        setErrorOnInputs(document.querySelector(`#${type}PersonalNumber`),true)
        console.log('Triggered Number');
        success = false;
    }
    
    if(landLine.length !== 0) {
        if(isValidPhonenumberCrew(landLine)) {
            setErrorOnInputs(document.querySelector(`#${type}LandLine`),true)
            success = false;
        }
    }

    if(salary != undefined) {
        if(salary.length === 0) {
            setErrorOnInputs(document.querySelector(`#crewSalary`),true)
            success = false;
        } else if(salary <= 0) {
            setErrorOnInputs(document.querySelector(`#crewSalary`),true)
            success = false;
        }
    }
    
    if(payDate != undefined) {
        if(payDate.length === 0) {
            setErrorOnInputs(document.querySelector(`#crewPayDate`),true)
            success = false;
        }else if(payDate > 31 || payDate <= 0) {
            success = false;
        }
    }

    

    if(success){

    }

    return success;
    // return false;
}

function isEmail (email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

