let crewCards = document.querySelectorAll('.card-crew')


$(document).ready(function() {
    let id;
    const orginalState = document.querySelector('.crew-form');
    crewCards.forEach((ele, index) => {
        $(ele).click(function() {
            id = ele.querySelector('.card-crew-id').innerHTML
            
            $(".crew-form-container").load("operations/get-card-crew-data.php", {
                id: id,
                flex: 'flex',
                marginTop: 'top-0'
            }, function() {
                UpdateListener();
            });
        })
    })

    
toggleText = true;
window.UpdateListener = function () {

    document.querySelector('.transformin-icon').classList.toggle('translate-icon');
    if(toggleText) {
        document.querySelector('.change-text-crew').innerHTML = "Cancel";
    } else {
        document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
    }
    toggleText = !toggleText;
    document.querySelector('.add-crew-form').classList.toggle('hidden');
    document.querySelector('.add-crew-form').classList.toggle('flex');
    document.querySelector('.crew-form-container').classList.toggle('hidden');
    document.querySelector('.crew-form-container').classList.toggle('block');
    console.log('Working Updated');

    ListenOnInputChanges(document.querySelector('#crewName'), 'crew')
    ListenOnInputChanges(document.querySelector('#crewEmail'), 'crew')
    ListenOnInputChanges(document.querySelector('#crewAddress'), 'crew')
    ListenOnInputChanges(document.querySelector('#crewPersonalNumber'), 'crew')
    ListenOnInputChanges(document.querySelector('#crewLandLine'), 'crew')


    //*  SALARY And Date Realtime Validate
    SalaryNDateInputListener(document.querySelector('#crewSalary'))
    SalaryNDateInputListener(document.querySelector('#crewPayDate'))
    
    $('#UpdateCrew').click(function() {

        const form_data = new FormData();
        const image = $("#crewUploadProfile")[0].files;
        console.log(image[0]);

        const name = $("#crewName").val();
        const email = $("#crewEmail").val();
        const address = $("#crewAddress").val();
        const birthday = $("#crewDOB").val();
        const personalNumber = $("#crewPersonalNumber").val();
        const landLine = $("#crewLandLine").val();
        const position = $("#crewPosition").val();
        // console.log(name);
        const shift = $("#crewShift").val();
        const salary = $("#crewSalary").val();
        const payDate = $("#crewPayDate").val();
        const CrewId = $("#CrewId").val();
        const CrewPreviousProfile = $("#CrewPreviousProfile").val();

        toggleText = true;
        if(!(validateCrewForms(name, email, address, personalNumber, salary, payDate, landLine, false, document.querySelector('#crewUploadProfile'), undefined))) {
            console.log('Not Validated');
            $(".crew-error-message").removeClass("hidden");
        } else {
            $(".crew-error-message").addClass("hidden");

            form_data.append('profileUpload', image[0]);
            form_data.append('name', name);
            form_data.append('email', email);
            form_data.append('address', address);
            form_data.append('birthday', birthday);
            form_data.append('mobile', personalNumber);
            form_data.append('landline', landLine);
            form_data.append('position', position);
            form_data.append('shift', shift);
            form_data.append('salary', salary);
            form_data.append('payDate', payDate);
            form_data.append('id', CrewId);
            form_data.append('prev_file', CrewPreviousProfile);
            $.ajax({
                url: 'operations/update-crew.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    document.querySelector('.transformin-icon').classList.toggle('translate-icon');
                    if(toggleText) {
                        document.querySelector('.change-text-crew').innerHTML = "Cancel";
                    } else {
                        document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
                    }
                    toggleText = !toggleText;
                    document.querySelector('.crew-form-container').classList.toggle('hidden');
                    document.querySelector('.crew-form-container').classList.toggle('flex');
                    location.reload();
                }
            });
        }
    })

    $("#DeleteCrew").click(function() {
        console.log('Deleting Crew Member');
        
        toggleText = true;
        
        const form_data = new FormData();
        const CrewId = $("#CrewId").val();
        const CrewPreviousProfile = $("#CrewPreviousProfile").val();
        form_data.append('id', CrewId);
        form_data.append('prev_file', CrewPreviousProfile);
        $.ajax({
            url: 'operations/delete-crew.php',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                // console.log(response);
                location.reload();
            }
        });

    })


    $(function(){
        $('#crewUploadProfile').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
             {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $(".CrewImageContainer").removeClass("border-blue-600")
                    $(".CrewImageContainer").removeClass("border-red-500")
                    $(".CrewImageContainer").addClass("border-green-500")
                   $('#crewUploadedProfile').attr('src', e.target.result);
                }
               reader.readAsDataURL(input.files[0]);
            }
            else
            {
              $('#crewUploadedProfile').attr('src', '/assets/no_preview.png');
            }
          });
        });
        

}

    
});

