$(document).ready(function() {

    let completeOrder = [];

    $("#Cart").click(function() {
        $(".checkout-menu").removeClass("scale-0");
        $("body").addClass("overflow-hidden");

        renderOrder();
    })
    
    $("#CartClose").click(function() {
        $(".checkout-menu").addClass("scale-0");
        $("body").removeClass("overflow-hidden");
    })

    $("#ApplyCoupen").click(function() {
        console.log("Order details");
        completeOrder.forEach(ele => {
            console.log(ele);
        })
        console.log("\n");
    })
})

window.renderOrder = function () {

        let selectedToppings = [];

        completeOrder = getCartData();

        if(completeOrder.length == 0) {

            $(".empty-cart").removeClass("hidden");
            $(".empty-cart").addClass("flex");

            $('.cart-header').removeClass('flex');
            $('.cart-header').addClass('hidden');
            
            
        } else {
            $(".empty-cart").addClass("hidden");
            $(".empty-cart").removeClass("flex");

            $('.cart-header').addClass('flex');
            $('.cart-header').removeClass('hidden');


            $(".cart-cards").load("operations/get-card-cards.php", {
                completeOrder: JSON.stringify(completeOrder),
            }, function() {
                const cartCards = document.querySelectorAll('.cart-card');
                CartCardHandler(cartCards);
                
                let PriceContainers = document.querySelectorAll('.totalPriceRes');

                let total = 0;
                PriceContainers.forEach(ele => {
                    total = total + parseInt(ele.innerHTML);
                    console.log(ele.innerHTML);
                })
                document.querySelector('.amount-button').innerHTML = "Rs." + total;
            })
        }

        // ? Handling all removing and adding parts of single cart card
        function CartCardHandler(List) {
            List.forEach(ele => {
                let remove = ele.querySelector('#CartCardRemove');
                console.log('Current Toppings');
                $(remove).click(function (){
                    getFinalOrder().forEach(ele => {
                        console.log(ele);
                    })
                })

                // ? Handling Toppings
                const toppingsCurrent = ele.querySelectorAll('.toppingAtCart');
                toppingsCurrent.forEach(topping => {
                    $(topping).click(function () {
                        topping.querySelector('svg').classList.toggle('hidden');
                        if(!(topping.querySelector('svg').classList.contains('hidden'))) {
                            console.log('Active');
    
                            let isSelected = selectedToppings.find(element => element == topping.querySelector('.tooping-id').innerHTML);
                            if(isSelected === undefined) {
                                selectedToppings.push(topping.querySelector('.tooping-id').innerHTML);
                            }
                        } else {
                            console.log('In-Active');
    
                            for(var i = 0; i < selectedToppings.length; i++) {
                                if(selectedToppings[i] == topping.querySelector('.tooping-id').innerHTML) {
                                    selectedToppings.splice(i, 1);
                                }
                            }
                        }
    
                        topping.classList.toggle('bg-black');
                        topping.classList.toggle('border');
                        topping.classList.toggle('border-gray-300');
    
                        let order = [];
                        order.push(topping.querySelector('.food-id').innerHTML);
                        order.push(topping.querySelector('.quantity-food-topping').innerHTML);
                        
                        var toppingsCurrent = [];
                        toppingsCurrent = JSON.parse(JSON.stringify(selectedToppings));
                        order.push(toppingsCurrent);
    
                        setToppingsAtCart(order);
    
                        // order = [];
                        // selectedToppings = [];
                    })
                })
            })
        }


        $("#isTakeaway").click(function() {
            $(".payment").toggleClass("hidden");
            $(".total-container").toggleClass("mt-14");
            $("#onlinePay").toggleClass("hidden");
            $("#onlinePay").toggleClass("flex");

            $("#confirmTakeaway").toggleClass("hidden");
            $("#confirmTakeaway").toggleClass("flex");
        })

        $("#confirmTakeaway").click(function(e) {
            e.preventDefault();

            const form_data = new FormData();
            const sessionId = document.querySelector('.sessionId').innerHTML;
            const deliveryMethod = 'takeaway';
            const basicPrice = document.querySelector('.basicPrice').innerHTML;
            form_data.append('sessionId', sessionId);
            form_data.append('deliveryMethod', deliveryMethod);
            form_data.append('basicPrice', basicPrice);
            form_data.append('quantity', proceedCheck);
            form_data.append('toppingsList', JSON.stringify(selectedToppingsIds));
            $.ajax({
                url: 'operations/take-away-order.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);

                    // setCartData();

                    $(".customize-menu").addClass("scale-0");
                    window.location.replace("foodMain.php");
                }
            });
        })
}

let finalOrder = [];

window.setToppingsAtCart = function (order) {
    finalOrder = [...finalOrder, order];
}

window.getFinalOrder = function () {
    return finalOrder;
}