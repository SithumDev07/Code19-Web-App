const crewCards = document.querySelectorAll('.card-crew')

// crewCards.forEach((ele, index) => {
//     ele.addEventListener('click', () => {
//         document.querySelector('.add-crew-form').classList.toggle('hidden');
//         document.querySelector('.add-crew-form').classList.toggle('flex');
//         document.querySelector('.transformin-icon').classList.toggle('translate-icon');
//         document.querySelector('.change-text-crew').innerHTML = "Cancel";
//         document.querySelector('.Crew').classList.toggle('overflow-y-auto');
//         document.querySelector('.Crew').classList.toggle('overflow-hidden');

//         const dataArray = [];
//         dataArray.push(ele.querySelector('.crew-name-card').innerHTML);
//         dataArray.push(ele.querySelector('.crew-address-card').innerHTML);
//         dataArray.push(ele.querySelector('.crew-address-card').innerHTML);

//         dataCrewMapping(document.querySelector('.add-crew-form'), dataArray);

//     })
// })


// function dataCrewMapping(ele, data) {
//     data.forEach((prop, index) => {
//         console.log(prop);
//     })
// }

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
            document.querySelector('.transformin-icon').classList.toggle('translate-icon');
            document.querySelector('.change-text-crew').innerHTML = "Cancel";
            document.querySelector('.Crew').classList.toggle('overflow-y-auto');
            document.querySelector('.Crew').classList.toggle('overflow-hidden');

            statusOriginal = false;

            $("#recuitEmployee").addClass("hidden");
            // alert(id)
        })
    })

    

    
});


function UpdateListener() {
    
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

        let toggleText = true;
        
        if(!(validateCrewForms(name, email, address, personalNumber, salary, payDate, landLine))) {
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
                    // location.reload();
                }
            });
        }
    })

}