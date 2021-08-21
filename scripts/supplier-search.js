
$(document).ready(function() {
    
    $("#searchSupplier").keyup(function() {
        let value = $(this).val();
        if(value !== '') {
            // $.ajax({
            //     url: 'operations/get-searched-crew.php',
            //     type: 'POST',
            //     data: {query: value, currentUser: currentUser},
            //     success: function(data, status) {
            //         // alert(data);
            //         // $(".left-crew").html(data);

            //         crewCards = document.querySelectorAll('.card-crew')
            //             updateCardsCrew();
                    

            //         }
            //     })

                $(".left-suppliers").load("operations/get-searched-suppliers.php", {
                    query: value,
                }, function() {
                    // alert(currentUser)
                    crewCards = document.querySelectorAll('.card-suppliers')
                    // updateCardsCrew();
                });
        }else {
            $(".left-suppliers").load("operations/get-all-suppliers.php", {}, function() {
                // * A;ways keep a flow, Trick is to load elements async
                crewCards = document.querySelectorAll('.card-suppliers')
                // updateCardsCrew();
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