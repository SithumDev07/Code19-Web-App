$(document).ready(function() {

    $("#signUpPop").click(function() {
        $(".signup-form").removeClass("scale-0");
        // $(".signup-form").removeClass("top-full");
    })
    
    $("#signup-close-button").click(function() {
        $(".signup-form").addClass("scale-0");
        // $(".signup-form").addClass("top-full");
    })
    
    $("#loginPop").click(function() {
        $(".login-form").removeClass("scale-0");
        // $(".signup-form").removeClass("top-full");
    })


    $("#loginCloseButton").click(function() {
        $(".login-form").addClass("scale-0");
        // $(".signup-form").addClass("top-full");
    })

    // ? Register
    LiveListerOnCustomerValidations(document.querySelector("#UsernameCustomer"));
    LiveListerOnCustomerValidations(document.querySelector("#FirstNameCustomer"));
    LiveListerOnCustomerValidations(document.querySelector("#LastNameCustomer"));
    LiveListerOnCustomerValidations(document.querySelector("#PasswordCustomer"));

    // ? Login 
    LiveListerOnCustomerValidations(document.querySelector("#UsernameCustomerLogin"));
    LiveListerOnCustomerValidations(document.querySelector("#PasswordCustomerLogin"));


    $("#SignupCustomer").click(function(e) {
        e.preventDefault();

        const form_data = new FormData();
        const username = $("#UsernameCustomer").val();
        const fullName = $("#FirstNameCustomer").val() + " " + $("#LastNameCustomer").val();
        const password = $("#PasswordCustomer").val();
        if(isValidated()) {

            form_data.append('username', username);
            form_data.append('fullName', fullName);
            form_data.append('password', password);
            $.ajax({
                url: 'operations/register-customer.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    if(response == 'Username is already taken') {
                        // alert(response);
                        document.querySelector(".err-message").innerHTML = "Sorry, Username is already taken. Please try another.";
                        document.querySelector(".err-message").classList.remove('hidden');
                        setErrorOnInputs(document.querySelector("#UsernameCustomer"),true);
                        document.querySelector("#UsernameCustomer").value = ''
                        document.querySelector("#PasswordCustomer").value = ''
                    } else if(response == 'Successfully Registered') {
                        alert(response);
                        $(".signup-form").addClass("scale-0");
                        window.location.replace("foodMain.php");
                    }
                }
            });
        }
    })


    $("#LoginCustomer").click(function(e) {
        console.log("It Working here");
        e.preventDefault();
        const form_data = new FormData();
        const username = $("#UsernameCustomerLogin").val();
        const password = $("#PasswordCustomerLogin").val();
        if(isValidatedLogin()) {

            form_data.append('username', username);
            form_data.append('password', password);
            $.ajax({
                url: 'operations/login-customer.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    if(response == 'User Not Found') {
                        alert(response);
                        document.querySelector(".err-message-login").innerHTML = "Sorry, User is not found. Please try again.";
                        document.querySelector(".err-message-login").classList.remove('hidden');
                        setErrorOnInputs(document.querySelector("#UsernameCustomerLogin"),true);
                        document.querySelector("#UsernameCustomerLogin").value = ''
                        document.querySelector("#PasswordCustomerLogin").value = ''
                    } else if(response == 'Wrong Password') {
                        alert(response);
                        document.querySelector(".err-message-login").innerHTML = "Wrong Password. Please try again.";
                        document.querySelector(".err-message-login").classList.remove('hidden');
                        setErrorOnInputs(document.querySelector("#PasswordCustomerLogin"),true);
                        document.querySelector("#PasswordCustomerLogin").value = ''
                    } else if(response == 'Success'){
                        $(".login-form").addClass("scale-0");
                        window.location.replace("foodMain.php");
                        // location.reload();
                    } else if(response == 'Restricted' || response == 'SQL Server Error') {
                        alert(response);
                        window.location.replace("page_not_found.php");
                    }
                }
            });
        }
    })

    let successSignup = false;
    function isValidated() {
        if(!validateSpecialCharacters(document.querySelector("#UsernameCustomer").value) && document.querySelector("#UsernameCustomer").value == '') {
            document.querySelector(".err-message").innerHTML = "Username is not filled correctly";
            document.querySelector(".err-message").classList.remove('hidden');
            setErrorOnInputs(document.querySelector("#UsernameCustomer"),true);
            successSignup = false;
        } else if(!validateSpecialCharacters(document.querySelector("#FirstNameCustomer").value) && document.querySelector("#FirstNameCustomer").value == '') {
            document.querySelector(".err-message").innerHTML = "First name is not filled correctly";
            document.querySelector(".err-message").classList.remove('hidden');
            setErrorOnInputs(document.querySelector("#FirstNameCustomer"),true);
            successSignup = false;
        } else if(!validateSpecialCharacters(document.querySelector("#LastNameCustomer").value) && document.querySelector("#LastNameCustomer").value == '') {
            document.querySelector(".err-message").innerHTML = "Last name is not filled correctly";
            document.querySelector(".err-message").classList.remove('hidden');
            setErrorOnInputs(document.querySelector("#LastNameCustomer"),true);
            successSignup = false;
        } else if(document.querySelector("#PasswordCustomer").value == '' && document.querySelector("#PasswordCustomer").value.length < 8) {
            document.querySelector(".err-message").innerHTML = "Password should contain at least 8 characters";
            document.querySelector(".err-message").classList.remove('hidden');
            setErrorOnInputs(document.querySelector("#PasswordCustomer"),true);
            successSignup = false;
        } else {
            document.querySelector(".err-message").classList.add('hidden');
            setErrorOnInputs(document.querySelector("#UsernameCustomer"),false);
            successSignup = true;
        }

        return successSignup;
    }


    let successLogin = false;
    function isValidatedLogin() {
        if(!validateSpecialCharacters(document.querySelector("#UsernameCustomerLogin").value) && document.querySelector("#UsernameCustomerLogin").value == '') {
            document.querySelector(".err-message-login").innerHTML = "Username is not filled correctly";
            document.querySelector(".err-message-login").classList.remove('hidden');
            setErrorOnInputs(document.querySelector("#UsernameCustomerLogin"),true);
            successLogin = false;
        } else if(document.querySelector("#PasswordCustomerLogin").value == '' && document.querySelector("#PasswordCustomerLogin").value.length < 8) {
            document.querySelector(".err-message-login").innerHTML = "Password should contain at least 8 characters";
            document.querySelector(".err-message-login").classList.remove('hidden');
            setErrorOnInputs(document.querySelector("#PasswordCustomerLogin"),true);
            successLogin = false;
        } else {
            document.querySelector(".err-message-login").classList.add('hidden');
            setErrorOnInputs(document.querySelector("#UsernameCustomerLogin"),false);
            setErrorOnInputs(document.querySelector("#PasswordCustomerLogin"),false);
            successLogin = true;
        }

        return successLogin;
    }

})

window.LiveListerOnCustomerValidations = function (ele) {
    $(ele).keyup(function() {
        if(ele.id !== `PasswordCustomer` && validateSpecialCharacters(ele.value)) {
            setErrorOnInputs(ele,true);
        } else if(ele.id === `PasswordCustomer` && ele.value.length < 8) {
            setErrorOnInputs(ele,true);
        } else {
            setErrorOnInputs(ele,false);
        }
    })
}

window.setErrorOnInputs = function (ele, error){
    if(error) {
        ele.classList.add('border-red-500')
        ele.classList.remove('border-green-500')
    } else {
        // console.log(ele.classList);
        ele.classList.add('border-green-500')
        ele.classList.remove('border-red-500')
    }
}