
$(document).ready(function() {
    
    $("#searchSupplier").keyup(function() {
        let value = $(this).val();
        if(value !== '') {

                $(".left-suppliers").load("operations/get-searched-suppliers.php", {
                    query: value,
                }, function() {
                    // alert(currentUser)
                    crewCards = document.querySelectorAll('.card-suppliers')
                    updateCardsSupplier();
                });
        }else {
            $(".left-suppliers").load("operations/get-all-suppliers.php", {}, function() {
                // * A;ways keep a flow, Trick is to load elements async
                SupplierCards = document.querySelectorAll('.card-suppliers')
                updateCardsSupplier(SupplierCards);
            });
        }
    })


    toggleText = true;

    function updateCardsSupplier(SupplierCards) {
        SupplierCards.forEach((ele, index) => {
            $(ele).click(function() {
                // TODO Remove after log
                console.log('update Cards Suppliers');
                id = ele.querySelector('.card-supplier-id').innerHTML
                
                $(".supplier-form-container").load("operations/get-card-supplier-data.php", {
                    id: id,
                    flex: 'flex',
                    marginTop: 'top-0'
                }, function() {
                    UpdateListenerSupplier();
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
    
})
