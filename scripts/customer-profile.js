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
        // TODO Interactions with customer profile
    })
})