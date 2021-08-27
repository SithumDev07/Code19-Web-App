let foodCards = document.querySelectorAll('.card-food');

$(document).ready(function() {
    let foodId;
    let proceedCheck = 0;
    foodCards.forEach((ele,index) => {
        $(ele).click(function() {
            $(".customize-menu").removeClass("scale-0");
            $("body").addClass("overflow-hidden");
            console.log('Clicking');
            foodId = ele.querySelector('.food-id').innerHTML;

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
            $(".customize-menu").addClass("scale-0");
            $("body").removeClass("overflow-hidden");
        })

        // ? Checkout
        $("#GoCheckout").click(function() {
            selectedToppingsIds.forEach(ele => {
                console.log("ID - ", ele);
            })
            console.log('\n');
            console.log(proceedCheck);
            // $(".popupmenu").removeClass('scale-0');
            $(".popupmenu-stay").removeClass('scale-0');
        })
        
        // ? Close Confirmation
        $("#CloseConfirmMenu").click(function () {
            $(".popupmenu").addClass('scale-0');
        })

        // ? Increasing Quantity
        $("#QuantityIncreaser").click(function() {
            document.querySelector(".quantity-customize").innerHTML = parseInt(document.querySelector(".quantity-customize").innerHTML) + 1;
            proceedCheck = parseInt(document.querySelector(".quantity-customize").innerHTML);
            // listenOnProceed();
            listenOnProceed();
        })
        
        // ? Decreasing Quantity
        $("#QuantityReducer").click(function() {
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


        $("#keepOrder").click(function() {
            $(".popupmenu-stay").addClass('scale-0');
            makeOrder();
            
        })


        $("#checkoutTakeaway").click(function(e) {
            $(".customize-menu").addClass("scale-0");
            $(".checkout-menu").removeClass("scale-0");
            $("body").addClass("overflow-hidden");
            makeOrder();
            renderOrder();
        })


    }


    function makeOrder() {
        console.log('adding data');
        let foodOrder= [];

        var toppingsCurrent = [];
        toppingsCurrent = JSON.parse(JSON.stringify(selectedToppingsIds));
        
        foodOrder.push(foodId);
        foodOrder.push(proceedCheck);
        foodOrder.push(toppingsCurrent);
        
        setCartData(foodOrder);
        
        toppingsCurrent = [];
        selectedToppingsIds = [];
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
            $(element).click(function() {

                if(!(element.querySelector('svg').classList.contains('hidden'))) {

                    let ifRemoved = selectedToppingsIds.find(ele => ele == element.querySelector('.fillingId').innerHTML)
                    console.log('in r food list? -', ifRemoved);
                    if(ifRemoved !== undefined) {
                        for(var i = 0; i < selectedToppingsIds.length; i++) {
                            if(selectedToppingsIds[i] == element.querySelector('.fillingId').innerHTML) {
                                selectedToppingsIds.splice(i, 1);
                            }
                        }
                    }

                } else {

                    let isSelected = selectedToppingsIds.find(ele => ele == element.querySelector('.fillingId').innerHTML)
                    if(isSelected === undefined) {
                        selectedToppingsIds.push(element.querySelector('.fillingId').innerHTML);
                    }

                }

                element.classList.toggle('bg-black');
                element.classList.toggle('border');
                element.classList.toggle('border-gray-300');
                element.querySelector('svg').classList.toggle('hidden');
            })
        })
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