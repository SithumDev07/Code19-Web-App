$(document).ready(function() {

    $("#recuitEmployee").click(function() {
        $(".crew-form-container").load("operations/get-recruit-data.php", {}, function() {
            RecruitListener();
        });
        

        statusOriginal = false;
    })

    

toggleText = true;
function RecruitListener() {

    const crewBirthday = document.querySelector('#crewDOB')

    if(crewBirthday !== null) {
        // console.log('Working');
        if(crewBirthday.value === '') {
            crewBirthday.value = newDate;
            crewBirthday.setAttribute("min", currentDate.replace(date.getFullYear(), minimumDate));
            crewBirthday.setAttribute("max", currentDate);
        }
    }

    ListenOnInputChanges(document.querySelector('#crewName'))
    ListenOnInputChanges(document.querySelector('#crewEmail'))
    ListenOnInputChanges(document.querySelector('#crewAddress'))
    ListenOnInputChanges(document.querySelector('#crewPersonalNumber'))
    ListenOnInputChanges(document.querySelector('#crewLandLine'))


    //*  SALARY And Date Realtime Validate
    SalaryNDateInputListener(document.querySelector('#crewSalary'))
    SalaryNDateInputListener(document.querySelector('#crewPayDate'))

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
    console.log('Working Recruit');
    
    // document.querySelector('.crew-form-container').classList.remove('hidden');
    // document.querySelector('.crew-form-container').classList.add('block');

    // document.querySelector('.transformin-icon').classList.toggle('translate-icon');
    // document.querySelector('.change-text-crew').innerHTML = "Cancel";


    $("#InsertCrew").click(function(e) {
        e.preventDefault();

        // const form = document.querySelector('#crew-form');
        const form_data = new FormData();
        const image = $("#crewUploadProfile")[0].files;
        console.log(image[0]);

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

        let toggleText = true;
        
        if(!(validateCrewForms(name, email, address, personalNumber, salary, payDate, landLine, true, document.querySelector('#crewUploadProfile')))) {
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
            $.ajax({
                url: 'operations/add-new-crew.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    // console.log(response);
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

})



