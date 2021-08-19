$(document).ready(function() {
    var Shift = 'Day';
    $(".crew-day").click(function() {
        Shift = "Day";
        $(".left-crew").load("operations/get-day-night-crew.php", {
            Shift: Shift
        }, function() {
            crewCards = document.querySelectorAll('.card-crew')
            updateCardsCrew();
        });
    })


    $(".crew-night").click(function() {
        Shift = "Night";
        $(".left-crew").load("operations/get-day-night-crew.php", {
            Shift: Shift
        }, function() {
            crewCards = document.querySelectorAll('.card-crew')
            updateCardsCrew();
        });
    })



    $(".all-crew").click(function() {
        $(".left-crew").load("operations/get-all-crew.php", {}, function() {
            // * A;ways keep a flow, Trick is to load elements async
            crewCards = document.querySelectorAll('.card-crew')
            updateCardsCrew();
        });
    })

    $("#InsertCrew").click(function() {
        
    })
});

// crewCards = document.querySelectorAll('.card-crew')
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