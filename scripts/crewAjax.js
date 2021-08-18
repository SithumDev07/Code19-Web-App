$(document).ready(function() {
    var Shift = 'Day';
    $(".crew-day").click(function() {
        Shift = "Day";
        $(".left-crew").load("operations/get-day-night-crew.php", {
            Shift: Shift
        });
    })


    $(".crew-night").click(function() {
        Shift = "Night";
        $(".left-crew").load("operations/get-day-night-crew.php", {
            Shift: Shift
        });
    })

    $(".all-crew").click(function() {
        $(".left-crew").load("operations/get-all-crew.php", {});
    })

    $("#InsertCrew").click(function() {
        
    })
});

