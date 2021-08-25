

$(document).ready(function() {
    
    $("#FoodSearch").keyup(function() {
        let value = $(this).val();
        console.log(value);
        if(value !== '') {

                $(".left-kitchen").load("operations/get-searched-foods.php", {
                    query: value,
                }, function() {
                    // alert(currentUser)
                    inventoryCards = document.querySelectorAll('.card-kitchen')
                    deleteCardsIngredients(inventoryCards);
                });
        }else {
            $(".left-kitchen").load("operations/get-all-foods.php", {}, function() {
                // * A;ways keep a flow, Trick is to load elements async
                InventoryCards = document.querySelectorAll('.card-kitchen')
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
