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

