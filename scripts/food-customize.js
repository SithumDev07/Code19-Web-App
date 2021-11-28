let foodCards = document.querySelectorAll('.card-food');

$(document).ready(function() {

    updateCartCounter();


    let foodId;
    let proceedCheck = 0;
    foodCards.forEach((ele,index) => {
        $(ele).click(function() {
            $(".customize-menu").removeClass("scale-0");
            $("body").addClass("overflow-hidden");
            foodId = ele.querySelector('.food-id').innerHTML;

            

            // TODO
            $(".customize-menu").load("operations/get-food-customize-data.php", {
                id: foodId,
            }, function() {
                const ToppingsContainer = document.querySelector('.toppings');
                const ToppingsList = ToppingsContainer.querySelectorAll('.toppings-buttons');
                customizeMenuHandler(foodId);
                toppingsListHandler(ToppingsList);
            })
        })
    })

    let selectedToppingsIds = [];

    toggleText = true;
    function customizeMenuHandler (foodId) {

        $(".quantity-customize").change(function() {
            if(proceedCheck !== 0) {
                document.querySelector("#GoCheckout").removeAttribute('disabled');
            } else {
                document.querySelector("#GoCheckout").setAttribute('disabled', '');
            }
        })

        $("#CloseCustomMenu").click(function() {

            let clearAmount = 0;
            if(document.querySelector(".quantity-customize").innerHTML == 0) {
                clearAmount = 0;
            } else {
                clearAmount = proceedCheck;
            }

            const form_data = new FormData();
            form_data.append('quantity', clearAmount);
            form_data.append('selectedfoodid', foodId);
            form_data.append('selectedToppings', JSON.stringify(selectedToppingsIds));
            console.log(selectedToppingsIds);
            $.ajax({
                url: 'operations/reset-inventory-customized.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);
                    $(".customize-menu").addClass("scale-0");
                    $("body").removeClass("overflow-hidden");
                }
            });



        })

        // ? Checkout
        $("#GoCheckout").click(function() {
            $(".popupmenu-stay").removeClass('scale-0');
        })
        
        // ? Close Confirmation
        $("#CloseConfirmMenu").click(function () {
            $(".popupmenu").addClass('scale-0');
        })

        // ? Increasing Quantity
        $("#QuantityIncreaser").click(function() {

            // ? Update the DB for the moment
            let form_data = new FormData();
            form_data.append('quantity', 1);
            form_data.append('selectedfoodid', foodId);
            $.ajax({
                url: 'operations/update-food-customized.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    // alert(response);
                    
                }
            });


            // ? Update the DB for the moment for toppings
            form_data = new FormData();
            form_data.append('quantity', 1);
            form_data.append('selectedToppings', JSON.stringify(selectedToppingsIds));
            $.ajax({
                url: 'operations/update-toppings-customized.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);
                    
                }
            });

            document.querySelector(".quantity-customize").innerHTML = parseInt(document.querySelector(".quantity-customize").innerHTML) + 1;
            proceedCheck = parseInt(document.querySelector(".quantity-customize").innerHTML);
            // listenOnProceed();
            listenOnProceed();
            console.log(selectedToppingsIds);
        })
        
        // ? Decreasing Quantity
        $("#QuantityReducer").click(function() {
            

            if(parseInt(document.querySelector(".quantity-customize").innerHTML) >= 1) {
                // ? Update the DB for the moment
                let form_data = new FormData();
                form_data.append('quantity', -1);
                form_data.append('selectedfoodid', foodId);
                $.ajax({
                    url: 'operations/update-food-customized.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
    
                        // alert(response);
                        
                    }
                });

                // ? Update the DB for the moment for toppings
                form_data = new FormData();
                form_data.append('quantity', -1);
                form_data.append('selectedToppings', JSON.stringify(selectedToppingsIds));
                $.ajax({
                    url: 'operations/update-toppings-customized.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        alert(response);
                        
                    }
                });
            }


            if(parseInt(document.querySelector(".quantity-customize").innerHTML) >= 1)
            document.querySelector(".quantity-customize").innerHTML = parseInt(document.querySelector(".quantity-customize").innerHTML) - 1;
            proceedCheck = parseInt(document.querySelector(".quantity-customize").innerHTML);
            listenOnProceed();
        })

        $("#takeAway").click(function(e) {
            
            $(".popupmenu").addClass('scale-0');
            $(".popupmenu-stay").removeClass('scale-0');

            // makeOrder();
            
        })

        // ? Refresh Page
        $(window).bind('beforeunload',function(){

            if(!(document.querySelector('.customize-menu').classList.contains('scale-0'))) {
                const form_data = new FormData();
                form_data.append('quantity', proceedCheck);
                form_data.append('selectedfoodid', foodId);
                form_data.append('selectedToppings', JSON.stringify(selectedToppingsIds));
                $.ajax({
                    url: 'operations/reset-inventory-customized.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
    
                        alert(response);
                    }
                });
            }

       
       });


        $("#keepOrder").click(function() {

            // ? Update the DB for the moment for toppings
            form_data = new FormData();
            form_data.append('quantity', -1);
            form_data.append('selectedToppings', JSON.stringify(selectedToppingsIds));
            $.ajax({
                url: 'operations/update-toppings-customized.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);
                    
                }
            });

            $(".popupmenu-stay").addClass('scale-0');
        
            const ToppingsContainer = document.querySelector('.toppings');
            const ToppingsList = ToppingsContainer.querySelectorAll('.toppings-buttons');
            ToppingsList.forEach(ele => {
                ele.classList.remove('bg-black');
                ele.classList.add('border');
                ele.classList.add('border-gray-300');
                ele.querySelector('svg').classList.add('hidden');
            })

            document.querySelector(".quantity-customize").innerHTML = 0;

            makeOrder();

            
        })


        $("#checkoutTakeaway").click(function(e) {

            // ? Update the DB for the moment for toppings
            form_data = new FormData();
            form_data.append('quantity', -1);
            form_data.append('selectedToppings', JSON.stringify(selectedToppingsIds));
            $.ajax({
                url: 'operations/update-toppings-customized.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);
                    
                }
            });

            $(".customize-menu").addClass("scale-0");
            $(".checkout-menu").removeClass("scale-0");
            $("body").addClass("overflow-hidden");
            makeOrder();
            renderOrder();
        })


    }


    function makeOrder() {
        let foodOrder= [];

        var toppingsCurrent = [];
        toppingsCurrent = JSON.parse(JSON.stringify(selectedToppingsIds));
        
        foodOrder.push(foodId);
        foodOrder.push(proceedCheck);
        foodOrder.push(toppingsCurrent);
        
        setCartData(foodOrder);
        
        toppingsCurrent = [];
        selectedToppingsIds = [];

        updateCartCounter();
    }

    function listenOnProceed() {
        // TODO Reminder for not a user
        if(proceedCheck !== 0 && document.querySelector('.sessionId').innerHTML !== 'NotAUser') {
            document.querySelector("#GoCheckout").removeAttribute('disabled');
        } else {
            document.querySelector("#GoCheckout").setAttribute('disabled', '');
        }
    }

    function toppingsListHandler(List) {
        List.forEach(element => {
            $(element).on('click', function() {

                // ? Adding
                let isSelected = selectedToppingsIds.find(ele => ele == element.querySelector('.fillingId').innerHTML)
                if(isSelected === undefined) {
                    selectedToppingsIds.push(element.querySelector('.fillingId').innerHTML);
                } else {
                    for(var i = 0; i < selectedToppingsIds.length; i++) {
                        if(selectedToppingsIds[i] == element.querySelector('.fillingId').innerHTML) {
                            selectedToppingsIds.splice(i, 1);
                        }
                    }
                }

                let fillingId = element.querySelector('.fillingId').innerHTML;
                $(".customize-menu-right .toppings").load("operations/get-realtime-toppings-data.php", {
                    fillingid: fillingId,
                    quantity: proceedCheck,
                    currentlySelected: JSON.stringify(selectedToppingsIds)
                }, function(reponse) {

                    toppingsButtonClickable(document.querySelectorAll('.toppings-buttons'));
                })

            })
        })
    }

    function toppingsButtonClickable(List) {
       
        toppingsListHandler(List);
    }
})


counter = 0;

// ? Declaring the arrays
let OrderCart = [];

window.setCartData = function(OrderDetails) {
    OrderCart = [...OrderCart, OrderDetails];
}

window.getCartData = function() {
    return OrderCart;
}

window.clearCartData = function() {
    OrderCart = [];
}

window.updateCartCounter = function() {
    if(getCartData().length === 0) {
        document.querySelector('.cart-counter').classList.add('hidden');
    } else {
        document.querySelector('.cart-counter').classList.remove('hidden');
        document.querySelector('.cart-counter').innerHTML = getCartData().length;
    }
}