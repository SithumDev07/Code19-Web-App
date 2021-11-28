
$(document).ready(function() {
    
    $("#crewSearchInput").keyup(function() {
        let value = $(this).val();
        if(value !== '') {
            const currentUser = $("#CurrentUser").val();
            $.ajax({
                url: 'operations/search-crew.php',
                type: 'POST',
                data: {query: value, currentUser: currentUser},
                success: function(data, status) {
                    // alert(data);
                    // $(".left-crew").html(data);
                    

                    $(".left-crew").load("operations/get-searched-crew.php", {
                        query: value,
                        currentUser: currentUser
                    }, function() {
                        // alert(currentUser)
                        crewCards = document.querySelectorAll('.card-crew')
                        updateCardsCrew();
                    });
                }
            })
        }else {
            const currentUser = $("#CurrentUser").val();
            $(".left-crew").load("operations/get-all-crew.php", {
                currentUser: currentUser
            }, function() {
                // * A;ways keep a flow, Trick is to load elements async
                crewCards = document.querySelectorAll('.card-crew')
                updateCardsCrew();
            });
        }
    })
    
})
// console.log(response);
// document.querySelector('.transformin-icon').classList.toggle('translate-icon');
// if(toggleText) {
//     document.querySelector('.change-text-crew').innerHTML = "Cancel";
// } else {
//     document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
// }
// toggleText = !toggleText;
// document.querySelector('.crew-form-container').classList.toggle('hidden');
// document.querySelector('.crew-form-container').classList.toggle('flex');
// location.reload();