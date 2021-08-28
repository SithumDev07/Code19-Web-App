$(document).ready(function() {
    $("#CustomerProfile").click(function() {
        $(".customer-profile").removeClass("scale-0");
        $("body").addClass("overflow-hidden");
    })

    $("#ProfileClose").click(function() {
        $(".customer-profile").addClass("scale-0");
        $("body").removeClass("overflow-hidden");
    })

    $("#addNewCard").click(function() {
        $(".add-card-profile").toggleClass("h-48");
        $(".add-card-profile").toggleClass("add-card-active");
    })


    const userId = document.querySelector('.sessionId').innerHTML;
    $(".profile-data").load("operations/get-customer-profile.php", {
        id: userId,
    }, function() {
        CustomerUpdateHandler();
    })

    function CustomerUpdateHandler() {
        LiveListerOnCustomerValidations(document.querySelector("#FirstNameCustomerProfile"));
        LiveListerOnCustomerValidations(document.querySelector("#LastNameCustomerProfile"));
        LiveMobileNumberValidation(document.querySelector('#CustomerPersonalNumber'));

        $("#LogOutCustomerProfile").click(function() {
            console.log("len - ", document.querySelector('#CustomerPersonalNumber').value.length);
            console.log("first - ", document.querySelector('#CustomerPersonalNumber').value.substring(0,2));
        })
    }

    function LiveMobileNumberValidation(ele) {
        $(ele).keyup(function() {
            
            if(!validatePhoneNumber(ele)) {
                setErrorOnInputs(ele,true);
            } else {
                setErrorOnInputs(ele,false);
            }
        })
    }

    function validatePhoneNumber(ele) {
        if(ele.value.substring(0, 2) === '94' && ele.value.length !== 11) {
            return false;
        } else if(ele.value.substring(0, 1) === '0' && ele.value.length !== 10) {
            return false
        } else {
            return true;
        }
    }

})