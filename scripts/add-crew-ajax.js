$(document).ready(function() {
    $("#InsertCrew").click(function(e) {
        e.preventDefault();

        const form = document.querySelector('#crew-form');
        const form_data = new FormData(form);
        const image = $("#crewUploadProfile")[0].files;
        console.log(image[0]);

        const name = $("#crewName").val();
        const email = $("#crewEmail").val();
        const address = $("#crewAddress").val();
        const crewUploadProfile = $("#crewUploadProfile").prop('files');
        const birthday = $("#crewDOB").val();
        const personalNumber = $("#crewPersonalNumber").val();
        const landLine = $("#crewLandLine").val();
        const position = $("#crewPosition").val();
        const shift = $("#crewShift").val();
        const salary = $("#crewSalary").val();
        const payDate = $("#crewPayDate").val();

        let toggleText = true;
        
        if(!(validateCrewForms(name, email, address, personalNumber, salary, payDate, landLine))) {
            console.log('Not Validated');
            $(".crew-error-message").removeClass("hidden");
        } else {
            $(".crew-error-message").addClass("hidden");

            form_data.append('profileUpload', image[0]);
            $.ajax({
                url: 'operations/add-new-crew.php',
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    // alert(response);
                    console.log(response);
                    document.querySelector('.transformin-icon').classList.toggle('translate-icon');
                    if(toggleText) {
                        document.querySelector('.change-text-crew').innerHTML = "Cancel";
                    } else {
                        document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
                    }
                    toggleText = !toggleText;
                    document.querySelector('.add-crew-form').classList.toggle('hidden');
                    document.querySelector('.add-crew-form').classList.toggle('flex');
                }
            });
        }
    })
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