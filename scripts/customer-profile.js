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

        $("#UpdateCustomerProfile").click(function(e) {
            e.preventDefault();

            if(validateInputsProfile()) {

                console.log("Validated");
                setErrorsOnUpdateButton(false);

                $(".err-message-update-profile").addClass("hidden");

                const sessionId = document.querySelector('.sessionId').innerHTML;
                const fullname = $("#FirstNameCustomerProfile").val() + " " + $("#LastNameCustomerProfile").val();
                const phone = $("#CustomerPersonalNumber").val();
                const address = $("#AddressCustomerProfile").val();
                const image = $("#UploadProfileCustomer")[0].files;
    
                const form_data = new FormData();
                form_data.append('sessionId', sessionId);
                form_data.append('fullname', fullname);
                form_data.append('phone', phone);
                form_data.append('address', address);
                form_data.append('profileCustomer', image[0]);
                // TODO 
                // $.ajax({
                //     url: 'operations/update-customer.php',
                //     type: 'POST',
                //     data: form_data,
                //     contentType: false,
                //     processData: false,
                //     success: function(response) {
                //         alert(response);
    
                //         $(".ustomer-profile").addClass("scale-0");
                //         window.location.replace("foodMain.php");
                //     }
                // });
            } else {
                console.log("Not Validated");
                setErrorsOnUpdateButton(true);


                $(".not-validated-icon").removeClass('hidden');
                $(".err-message-update-profile").removeClass("hidden");
            }

        })

        // TODO Logout
        $("#LogOutCustomerProfile").click(function() {
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