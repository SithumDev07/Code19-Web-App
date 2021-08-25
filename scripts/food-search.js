

$(document).ready(function() {
    
    $("#FoodSearch").keyup(function() {
        let value = $(this).val();
        console.log(value);
        if(value !== '') {

                $(".left-kitchen").load("operations/get-searched-foods.php", {
                    query: value,
                }, function() {
                    // alert(currentUser)
                    const foodCards = document.querySelectorAll('.card-kitchen')
                    OpenFoodCards(foodCards);
                });
        }else {
            $(".left-kitchen").load("operations/get-all-foods.php", {}, function() {
                // * A;ways keep a flow, Trick is to load elements async
                const foodCards = document.querySelectorAll('.card-kitchen')
                OpenFoodCards(foodCards);
            });
        }
    })


    toggleText = true;
    function OpenFoodCards(foodCards) {
        let foodId;
        foodCards.forEach((ele, index) => {
            $(ele).click(function() {
                foodId = ele.querySelector('.card-food-id').innerHTML;
                
                $(".kitchen-form-container").load("operations/get-kitchen-data-update.php", {
                    id: foodId,
                }, function() {
                    UpdateListenerKitchen(foodId);
                });
            })
        })
    }
    
})
