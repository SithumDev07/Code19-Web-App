$(document).ready(function() {

    // ? Credit Card Area
    $("#addNewCard").click(function() {
        $(".add-card-profile").toggleClass("h-48");
        $(".add-card-profile").toggleClass("add-card-active");
        const addNewcard = document.querySelector("#addNewCard");
        addNewcard.querySelector('svg').classList.toggle('rotate-45');
        $('.payment-profile').toggleClass('xl:overflow-y-scroll');
        $('.payment-profile').toggleClass('2xl:overflow-hidden');
        $(".credit-card-warning").toggleClass('hidden');
        $(".hidden-credit-card").toggleClass('hidden');
        $(".hidden-credit-card").toggleClass('flex');
    })

    $("#expandCardInputsCart").click(function() {
        $(".add-card").toggleClass("h-48");
        $(".add-card").toggleClass("add-card-active");
        const addNewcard = document.querySelector("#expandCardInputsCart");
        addNewcard.querySelector('svg').classList.toggle('rotate-45');
        if(document.querySelector('.credit-card-warning').classList.contains('should-show')) {
            $(".credit-card-warning").toggleClass('hidden');
        }
        $(".hidden-credit-card-cart").toggleClass('hidden');
        $(".hidden-credit-card-cart").toggleClass('flex');
    })

    $("#ConfirmCard").click(function(e) {
        e.preventDefault();
        if(validateCreditCardInfo(document.querySelector('#nameOnCardProfile'), 'Profile') && validateCreditCardInfo(document.querySelector('#cardNumberProfile'), 'Profile') && validateCreditCardInfo(document.querySelector('#expireDateProfile'), 'Profile') && validateCreditCardInfo(document.querySelector('#CVCProfile'), 'Profile')) {
            console.log('validated');
            document.querySelector('.err-message-card-profile').classList.add('hidden');
            

            const sessionId = document.querySelector('.sessionId').innerHTML;

            const nameOnCard = $("#nameOnCardProfile").val();
            const cardNumber = $("#cardNumberProfile").val();
            const expireDate = $("#expireDateProfile").val();
            const cvc = $("#CVCProfile").val();
            let number = cardNumber.replace(/\s/g, '');
            const cardType = getCreditCardType(parseInt(number));

            const form_data = new FormData();
            form_data.append('sessionId', sessionId);
            form_data.append('nameuponcard', nameOnCard);
            form_data.append('cardnumber', number);
            form_data.append('cardtype', cardType);
            form_data.append('expiredate', expireDate);
            form_data.append('cvc', cvc);
            $.ajax({
                url: 'operations/add-new-credit-card.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);

                    $(".customer-profile").addClass("scale-0");
                    window.location.replace("foodMain.php");
                }
            });
        }
        else{
            document.querySelector('.err-message-card-profile').classList.remove('hidden');
            document.querySelector('.err-message-card-profile').innerHTML = message;
            console.log('not');
        } 
    })

    // ? Update Existing Card
    $("#UpdateCard").click(function(e) {
        e.preventDefault();
        if(validateCreditCardInfo(document.querySelector('#nameOnCardProfile'), 'Profile') && validateCreditCardInfo(document.querySelector('#cardNumberProfile'), 'Profile') && validateCreditCardInfo(document.querySelector('#expireDateProfile'), 'Profile') && validateCreditCardInfo(document.querySelector('#CVCProfile'), 'Profile')) {
            console.log('validated');
            document.querySelector('.err-message-card-profile').classList.add('hidden');
            

            const creditCardId = document.querySelector('.credit-card-id').innerHTML;

            const nameOnCard = $("#nameOnCardProfile").val();
            const cardNumber = $("#cardNumberProfile").val();
            const expireDate = $("#expireDateProfile").val();
            const cvc = $("#CVCProfile").val();
            let number = cardNumber.replace(/\s/g, '');
            const cardType = getCreditCardType(parseInt(number));

            const form_data = new FormData();
            form_data.append('cardid', creditCardId);
            form_data.append('nameuponcard', nameOnCard);
            form_data.append('cardnumber', number);
            form_data.append('cardtype', cardType);
            form_data.append('expiredate', expireDate);
            form_data.append('cvc', cvc);
            $.ajax({
                url: 'operations/update-credit-card.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);

                    $(".customer-profile").addClass("scale-0");
                    window.location.replace("foodMain.php");
                }
            });
        }
        else{
            document.querySelector('.err-message-card-profile').classList.remove('hidden');
            document.querySelector('.err-message-card-profile').innerHTML = message;
            console.log('not');
        } 
    })


    // ? Confirm at cart
    $("#ConfirmCardCart").click(function(e) {
        e.preventDefault();
        if(validateCreditCardInfo(document.querySelector('#nameOnCardCart'), 'Cart') && validateCreditCardInfo(document.querySelector('#cardNumberCart'), 'Cart') && validateCreditCardInfo(document.querySelector('#expireDateCart'), 'Cart') && validateCreditCardInfo(document.querySelector('#CVCCart'), 'Cart')) {
            console.log('validated');
            document.querySelector('.err-message-card-profile').classList.add('hidden');

            // TODO
            $(".add-card").toggleClass("h-48");
            $(".add-card").toggleClass("add-card-active");
            const addNewcard = document.querySelector("#expandCardInputsCart");
            addNewcard.querySelector('svg').classList.toggle('rotate-45');
            $(".credit-card-warning").addClass('hidden');
            $(".credit-card-warning").removeClass('should-show');
            $(".hidden-credit-card-cart").removeClass('hidden');
            $(".hidden-credit-card-cart").addClass('flex');

            document.querySelector("#onlinePay").removeAttribute('disabled');
        }
        else{
            document.querySelector('.err-message-card-profile').classList.remove('hidden');
            document.querySelector('.err-message-card-profile').innerHTML = message;
            console.log('not');
        } 
    })


    // ? Remove Existing Card
    $("#removeCard").click(function(e) {
        e.preventDefault();
        const creditCardId = document.querySelector('.credit-card-id').innerHTML;

        const form_data = new FormData();
        form_data.append('cardid', creditCardId);
        $.ajax({
            url: 'operations/delete-credit-card.php',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response) {

                alert(response);

                $(".customer-profile").addClass("scale-0");
                window.location.replace("foodMain.php");
            }
        });
    })

    let message;
    // let success = false;
    let currentYear = new Date().getFullYear();
    function validateCreditCardInfo(ele, name) {
        // success = true;
        let success = true;
        if(ele.id == `nameOnCard${name}` && (validateSpecialCharacters(ele.value) || isContainNumbers(ele.value) || ele.value.length == 0)) {
            message = "Oops! You've entered name incorrectly. Please try again.";
            success = false;
            setErrorOnInputsCards(ele, true);
        }
        
        if(ele.id == `cardNumber${name}` && (ele.value.length !== 14 || ele.value.length == 0)) {
            success = false;
            message = "Sorry! Card number cannot contain text and it should be 12 digits.";
            setErrorOnInputsCards(ele, true);
        } 
        
        if(ele.id == `expireDate${name}` && (parseInt(ele.value.substring(0,3)) < parseInt(currentYear.toString().substring(2)) || ele.value.length == 0)) {
            message = "Opps! Seems to be your card is expired or you haven't filled yet.";
            success = false;
            setErrorOnInputsCards(ele, true);
        } else if(ele.id == `expireDate${name}` && (!(0 < parseInt(ele.value.substring(3)) && parseInt(ele.value.substring(3)) < 13) || ele.value.length == 0)) {
            message = "Sorry! You have entered wrong month. Check with your card again.";
            success = false;
            setErrorOnInputsCards(ele, true);
        }
        
        if(ele.id == `CVC${name}` && (ele.value.length !== 3 || ele.value.length == 0)) {
            message = "Hmm! CVC number should be 3 digits and shouldn't be contain text.";
            success = false;
            setErrorOnInputsCards(ele, true);
        }

        return success;
    }

    ListenerInputsCard(document.querySelector('#nameOnCardProfile'), 'cardName')
    ListenerInputsCard(document.querySelector('#expireDateProfile'), 'expireDate')
    ListenerInputsCard(document.querySelector('#cardNumberProfile'), 'cardNumber')
    ListenerInputsCard(document.querySelector('#CVCProfile'), 'CVC')

    
    ListenerInputsCard(document.querySelector('#nameOnCardCart'), 'cardName')
    ListenerInputsCard(document.querySelector('#expireDateCart'), 'expireDate')
    ListenerInputsCard(document.querySelector('#cardNumberCart'), 'cardNumber')
    ListenerInputsCard(document.querySelector('#CVCCart'), 'CVC')


    function ListenerInputsCard(ele, type){
        $(ele).keyup(function() {
            let value = $(this).val();
            if(type == 'cardName') {
                if(validateSpecialCharacters(ele.value) || isContainNumbers(ele.value) || ele.value.length == 0) {
                    setErrorOnInputsCards(ele, true);
                } else {
                    setErrorOnInputsCards(ele, false);
                }
                if(value.length > 16){
                    document.querySelector('.card-name-display').innerHTML = value.toString().substring(0,16) + "...";
                } else {
                    document.querySelector('.card-name-display').innerHTML = value;
                }

            } else if(type == 'cardNumber'){
                let number = value.replace(/\s/g, '');
                console.log(isOnlyText(number));

                if(!isContainNumbers(number) || number.length == 0) {
                    setErrorOnInputsCards(ele, true);
                } else if(number.length !== 12) {
                    setErrorOnInputsCards(ele, true);
                } else {
                    setErrorOnInputsCards(ele, false);
                }
                document.querySelector('.card-number-display').innerHTML = value;
                document.querySelector('.card-type-display').innerHTML = getCreditCardType(parseInt(number));

                switch (value.length) {
                    case 4:
                        ele.value = value + " ";
                        console.log('Its 4');
                        break;
                    case 9:
                        ele.value = value + " ";
                        break;
                    default:
                        break;
                }
            } else if(type == 'expireDate') {
                if(parseInt(ele.value.substring(0,3)) < parseInt(currentYear.toString().substring(2)) || ele.value.length == 0) {
                    setErrorOnInputsCards(ele, true);
                } else if(!(0 < parseInt(ele.value.substring(3)) && parseInt(ele.value.substring(3)) < 13) || ele.value.length == 0) {
                    setErrorOnInputsCards(ele, true);
                } else {
                    setErrorOnInputsCards(ele, false);
                }
                document.querySelector('.expire-date-display').innerHTML = value;

                if(value.length == 2) {
                    ele.value = value + "/";
                }
            } else if(type == 'CVC') {
                if(ele.value.length !== 3 || ele.value.length == 0 || !isContainNumbers(value)) {
                    setErrorOnInputsCards(ele, true);
                } else {
                    setErrorOnInputsCards(ele, false);
                }
            }
        })
    }

    function setErrorOnInputsCards(ele, status) {
        if(status) {
            // $(ele).addClass('border-2');
            $(ele).addClass('bg-red-400');
            $(ele).removeClass('bg-opacity-50');
        } else {
            $(ele).addClass('bg-opacity-50');
            $(ele).removeClass('bg-red-400');
        }
    }

    function isContainNumbers(value) {
        return /\d/.test(value);
    }

    function isOnlyText(value) {
        return /^[a-zA-Z0-9@]+$/.test(value);
    }
    
    // console.log("TYPE - ", getCreditCardType(421689223682));

    function getCreditCardType(value) {
        let VISA = /^4[0-9]{6,}$/;
        let MASTERCARD = /^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$/;
        let AMERICAN_EXPRESS = /^3[47][0-9]{5,}$/;
        let DINERS_CLUB = /^3(?:0[0-5]|[68][0-9])[0-9]{4,}$/;
        let DISCOVER = /^6(?:011|5[0-9]{2})[0-9]{3,}$/;
        let JCB = /^(?:2131|1800|35[0-9]{3})[0-9]{3,}$/;

        switch(true) {
            case VISA.test(value):
                return 'VISA';
            case MASTERCARD.test(value):
                return 'MASTER CARD';
            case AMERICAN_EXPRESS.test(value):
                return 'AMERICAN EXPRESS';
            case DINERS_CLUB.test(value):
                return 'DINERS CLUB';
            case DISCOVER.test(value):
                return 'DISCOVER';
            case JCB.test(value):
                return 'JSB';
            default:
                return 'UNRECOGNIZED';
        }
    }


    // ? Profile Area
    $("#CustomerProfile").click(function() {
        $(".customer-profile").removeClass("scale-0");
        $("body").addClass("overflow-hidden");
    })

    $("#ProfileClose").click(function() {
        $(".customer-profile").addClass("scale-0");
        $("body").removeClass("overflow-hidden");
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

        $("#UpdateCustomerProfile").click(function(e) {
            e.preventDefault();

            if(validateInputsProfile()) {

                console.log("Validated");
                setErrorsOnUpdateButton(false);

                $(".err-message-update-profile").addClass("hidden");

                const sessionId = document.querySelector('.sessionId').innerHTML;
                let fullname = '';
                if(document.querySelector("#LastNameCustomerProfile").value.length === 0) {
                    fullname = $("#FirstNameCustomerProfile").val();
                } else {
                    fullname = $("#FirstNameCustomerProfile").val() + " " + $("#LastNameCustomerProfile").val();
                }
                const phone = $("#CustomerPersonalNumber").val();
                const address = $("#AddressCustomerProfile").val();
                const image = $("#UploadProfileCustomer")[0].files;
    
                const form_data = new FormData();
                form_data.append('sessionId', sessionId);
                form_data.append('fullname', fullname);
                form_data.append('phone', phone);
                form_data.append('address', address);
                form_data.append('profileCustomer', image[0]);
                $.ajax({
                    url: 'operations/update-customer.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
    
                        $(".ustomer-profile").addClass("scale-0");
                        window.location.replace("foodMain.php");
                    }
                });
            } else {
                console.log("Not Validated");
                setErrorsOnUpdateButton(true);


                $(".not-validated-icon").removeClass('hidden');
                $(".err-message-update-profile").removeClass("hidden");
            }

        })

        
        $("#LogOutCustomerProfile").click(function() {
            window.location.replace("foodMain.php?clear");
        })


        $("#DeleteCustomerProfile").click(function() {
            const sessionId = document.querySelector('.sessionId').innerHTML;

            const form_data = new FormData();
            form_data.append('sessionId', sessionId);
            $.ajax({
                url: 'operations/delete-customer.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);

                    $(".ustomer-profile").addClass("scale-0");
                    window.location.replace("foodMain.php?clear");
                }
            });
        })


        $(function(){
            $('#UploadProfileCustomer').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                 {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $(".profile-picture-customer").removeClass("border-blue-600")
                        $(".profile-picture-customer").removeClass("border-red-500")
                        $(".profile-picture-customer").addClass("border-green-500")
                       $('#UploadedProfile').attr('src', e.target.result);
                    }
                   reader.readAsDataURL(input.files[0]);
                }
                else
                {
                  $('#UploadedProfile').attr('src', '/assets/no_preview.png');
                }
              });
            });
    }

    function setErrorsOnUpdateButton(status) {
        if(status) {
            $("#UpdateCustomerProfile").removeClass('text-gray-300');
            $("#UpdateCustomerProfile").addClass('text-gray-900');
            $("#UpdateCustomerProfile").removeClass('bg-blue-600');
            $("#UpdateCustomerProfile").addClass('bg-yellow-400');
            $("#UpdateCustomerProfile").removeClass('hover:bg-blue-700');
            $("#UpdateCustomerProfile").addClass('hover:bg-yellow-500');
            $(".validated-icon").addClass('hidden');
            $(".not-validated-icon").removeClass('hidden');
        } else {
            $("#UpdateCustomerProfile").addClass('text-gray-300');
            $("#UpdateCustomerProfile").removeClass('text-gray-900');
            $("#UpdateCustomerProfile").addClass('bg-blue-600');
            $("#UpdateCustomerProfile").removeClass('bg-yellow-400');
            $("#UpdateCustomerProfile").addClass('hover:bg-blue-700');
            $("#UpdateCustomerProfile").removeClass('hover:bg-yellow-500');
            $(".validated-icon").removeClass('hidden');
            $(".not-validated-icon").addClass('hidden');
        }
    }

    function validateInputsProfile() {
        let succes = true;
        if(document.querySelector('#FirstNameCustomerProfile').value.length === 0 || validateSpecialCharacters(document.querySelector('#FirstNameCustomerProfile').value)) {
            succes = false;
            setErrorOnInputs(document.querySelector('#FirstNameCustomerProfile'),true);
            document.querySelector('.err-message-update-profile').innerHTML = "Oops! First name cannot be empty and cannot contain special characters. Please fill again.";
        }
        
        if(document.querySelector('#LastNameCustomerProfile').value.length !== 0 && validateSpecialCharacters(document.querySelector('#LastNameCustomerProfile').value)) {
            succes = false;
            setErrorOnInputs(document.querySelector('#LastNameCustomerProfile'),true);
            document.querySelector('.err-message-update-profile').innerHTML = "Oops! Last name cannot contain special characters. Please try again.";
        }
        
        if(document.querySelector('#CustomerPersonalNumber').value.length !== 0 && !validatePhoneNumber(document.querySelector('#CustomerPersonalNumber'))) {
            succes = false;
            setErrorOnInputs(document.querySelector('#CustomerPersonalNumber'),true);
            document.querySelector('.err-message-update-profile').innerHTML = "Sorry, You have entered invalid phone number. Please double check";
        }

        const customerProfile = document.querySelector("#UploadProfileCustomer");
        const customerProfileContainer = document.querySelector(".profile-picture-customer");
        if(customerProfile.files.length !== 0) {
            if(!isValidExtention(customerProfile)) {
                setErroOnCustomerImage(true, customerProfileContainer)
                succes = false;
                document.querySelector('.err-message-update-profile').innerHTML = "Oops! Only Allwed JPG JPEG PNG PDF only. Try another.";
            }
            
            if(!isValidImageSize(customerProfile)) {
                setErroOnCustomerImage(true, customerProfileContainer)
                succes=false;
                document.querySelector('.err-message-update-profile').innerHTML = "Sorry, Please upload a image less than 3MB.";
            }
        }

        if(succes) {
            setErroOnCustomerImage(false, customerProfileContainer);
        }

        return succes;
    }

    function setErroOnCustomerImage(error, container) {
        if(error) {
            container.classList.add('border-3')
            container.classList.add('p-2')
            container.classList.add('border-red-500')
        } else {
            container.classList.remove('border-3')
            container.classList.remove('p-2')
            container.classList.remove('border-red-500')
        }
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