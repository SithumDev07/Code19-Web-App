$(document).ready(function() {
    var Shift = 'Day';
    $(".crew-day").click(function() {
        Shift = "Day";
        const currentUser = $("#CurrentUser").val();
        $(".left-crew").load("operations/get-day-night-crew.php", {
            Shift: Shift,
            currentUser: currentUser
        }, function() {
            crewCards = document.querySelectorAll('.card-crew')
            updateCardsCrew();
        });
    })


    $(".crew-night").click(function() {
        Shift = "Night";
        const currentUser = $("#CurrentUser").val();
        $(".left-crew").load("operations/get-day-night-crew.php", {
            Shift: Shift,
            currentUser: currentUser
        }, function() {
            crewCards = document.querySelectorAll('.card-crew')
            updateCardsCrew();
        });
    })



    $(".all-crew").click(function() {
        const currentUser = $("#CurrentUser").val();
        $(".left-crew").load("operations/get-all-crew.php", {
            currentUser: currentUser
        }, function() {
            // * A;ways keep a flow, Trick is to load elements async
            crewCards = document.querySelectorAll('.card-crew')
            updateCardsCrew();
        });
    })

    toggleText = true;

function updateCardsCrew() {
    crewCards.forEach((ele, index) => {
        $(ele).click(function() {
            console.log('update Cards');
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
}

});

// crewCards = document.querySelectorAll('.card-crew')
