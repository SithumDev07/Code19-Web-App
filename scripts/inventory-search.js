

$(document).ready(function() {
    
    $("#InventorySearch").keyup(function() {
        let value = $(this).val();
        if(value !== '') {

                $(".left-inventory").load("operations/get-searched-ingredients.php", {
                    query: value,
                }, function() {
                    // alert(currentUser)
                    inventoryCards = document.querySelectorAll('.card-inventory')
                    deleteCardsIngredients(inventoryCards);
                });
        }else {
            $(".left-inventory").load("operations/get-all-ingredients.php", {}, function() {
                // * A;ways keep a flow, Trick is to load elements async
                InventoryCards = document.querySelectorAll('.card-inventory')
                deleteCardsIngredients(InventoryCards);
            });
        }
    })


    toggleText = true;

    function deleteCardsIngredients(InventoryCards) {
        InventoryCards.forEach((ele, index) => {
            $(ele).click(function() {
                // TODO Remove after log
                console.log('delete Cards Ingredients');
                id = ele.querySelector('.card-inventory-id').innerHTML
                
                $(".inventory-form-container").load("operations/get-card-inventory-data.php", {
                    id: id,
                }, function() {
                    DeleteListenerInventory();
                });
                
                statusOriginal = false;
            })
        })
    }
    
})
