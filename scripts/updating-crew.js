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
            // document.querySelector('.add-crew-form').classList.toggle('hidden');
            // document.querySelector('.add-crew-form').classList.toggle('flex');
            // document.querySelector('.crew-form-container').classList.toggle('hidden');
            

            statusOriginal = false;

            // $("#recuitEmployee").addClass("hidden");
            // alert(id)
        })
    })

    

    
});

toggleText = true;
function UpdateListener() {

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

    
    // document.querySelector('.crew-form-container').classList.remove('hidden');
    // document.querySelector('.crew-form-container').classList.add('block');
    document.querySelector('.transformin-icon').classList.toggle('translate-icon');
    document.querySelector('.change-text-crew').innerHTML = "Cancel";
    // document.querySelector('.Crew').classList.toggle('overflow-y-auto');
    // document.querySelector('.Crew').classList.toggle('overflow-hidden');
    
    document.querySelector('#UpdateCrew').addEventListener('click', () => {

    
    // $("#UpdateCrew").click(function(e) {
        // e.preventDefault();

        // const form = document.querySelector('#crew-form');
        const form_data = new FormData();
        const image = $("#crewUploadProfile")[0].files;
        console.log(image[0]);
        console.log('Triggereee');

        const name = $("#crewName").val();
        const email = $("#crewEmail").val();
        const address = $("#crewAddress").val();
        // const crewUploadProfile = $("#crewUploadProfile").prop('files');
        const birthday = $("#crewDOB").val();
        const personalNumber = $("#crewPersonalNumber").val();
        const landLine = $("#crewLandLine").val();
        const position = $("#crewPosition").val();
        const shift = $("#crewShift").val();
        const salary = $("#crewSalary").val();
        const payDate = $("#crewPayDate").val();
        const CrewId = $("#CrewId").val();
        const CrewPreviousProfile = $("#CrewPreviousProfile").val();

        toggleText = true;

            ListenOnInputChanges(document.querySelector('#crewName'), 'crew')
            ListenOnInputChanges(document.querySelector('#crewEmail'), 'crew')
            ListenOnInputChanges(document.querySelector('#crewAddress'), 'crew')
            ListenOnInputChanges(document.querySelector('#crewPersonalNumber'), 'crew')
            ListenOnInputChanges(document.querySelector('#crewLandLine'), 'crew')


            //*  SALARY And Date Realtime Validate
            SalaryNDateInputListener(document.querySelector('#crewSalary'))
            SalaryNDateInputListener(document.querySelector('#crewPayDate'))
        
        if(!(validateCrewForms(name, email, address, personalNumber, salary, payDate, landLine, false, document.querySelector('#crewUploadProfile')))) {
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
                    // console.log(response);
                    location.reload();
                }
            });
        }
    })

    document.querySelector("#DeleteCrew").addEventListener('click', () => {
   
        
        let toggleText = true;
        
        const form_data = new FormData();
        console.log('Triggereee Delete');
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