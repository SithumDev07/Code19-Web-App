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

        updateCartCounter();
    })

    
})


window.renderOrder = function () {

        let selectedToppings = [];
        let selectedToppingsButtons = [];
        let totalToppingsElements = [];
        let eachToppingPrice = [];
        let totalEachPrice;

        completeOrder = getCartData();

        if(completeOrder.length == 0) {

            $(".empty-cart").removeClass("hidden");
            $(".empty-cart").addClass("flex");

            $('.cart-header').removeClass('flex');
            $('.cart-header').addClass('hidden');


            $('.takeawayContainer').removeClass('flex');
            $('.takeawayContainer').addClass('hidden');
            
            
        } else {
            $(".empty-cart").addClass("hidden");
            $(".empty-cart").removeClass("flex");

            $('.cart-header').addClass('flex');
            $('.cart-header').removeClass('hidden');

            $('.takeawayContainer').addClass('flex');
            $('.takeawayContainer').removeClass('hidden');


            $(".cart-cards").load("operations/get-card-cards.php", {
                completeOrder: JSON.stringify(completeOrder),
            }, function() {
                const cartCards = document.querySelectorAll('.cart-card');
                CartCardHandler(cartCards);
                
                let PriceContainers = document.querySelectorAll('.totalPriceRes');

                let total = 0;
                PriceContainers.forEach(ele => {
                    total = total + parseInt(ele.innerHTML);
                })

                UpdateTotalPrice();
            })
        }

        let toppingIdsByOrder = [];
        let toppingPriceByOrder = [];
        let EachFoodPriceByOrder = [];

        $("#onlinePay").unbind().click(function () {
            console.log('Current Complete Order');
            getCartData().forEach(ele => {
                console.log(ele);
            })

            console.log(document.querySelector('.grandTotal').innerHTML);
        })

       

        // ? Handling all removing and adding parts of single cart card
        function CartCardHandler(List) {
            List.forEach((ele, index) => {

                // ? Removing Specific Order 
                let remove = ele.querySelector('#CartCardRemove');
                $(remove).click(function (){
                    
                    if(completeOrder.length == 1) {

                        completeOrder.splice(index, 1);
                        toppingPriceByOrder.splice(index, 1);
                        EachFoodPriceByOrder.splice(index, 1);
    
                        ele.classList.add('hidden');
    
                        UpdateTotalPrice();

                        $(".checkout-menu").addClass("scale-0");
                        $("body").removeClass("overflow-hidden");
                        updateCartCounter();
                    } else {
                        completeOrder.splice(index, 1);
                        toppingPriceByOrder.splice(index, 1);
                        EachFoodPriceByOrder.splice(index, 1);
    
                        ele.classList.add('hidden');
    
                        UpdateTotalPrice();
                    }
                })

                selectedToppingsButtons = ele.querySelectorAll('.toppingAtCart');
                
                selectedToppingsButtons.forEach(ele => {
                    selectedToppings.push(ele.querySelector('.tooping-id').innerHTML);
                })

                toppingIdsByOrder = [...toppingIdsByOrder, selectedToppings];

                selectedToppings = [];


                // ? Calculating Topping Prices
                totalToppingsElements = ele.querySelectorAll('.toppingPrices');
                totalToppingsElements.forEach(ele => {
                    eachToppingPrice.push(ele.innerHTML);
                })

                toppingPriceByOrder = [...toppingPriceByOrder, eachToppingPrice];

                eachToppingPrice = [];


                // ? Getting all the each food prices
                totalEachPrice = ele.querySelector(".eachFoodPrice").innerHTML;
                EachFoodPriceByOrder.push(totalEachPrice);

                // ? Handling Toppings
                const toppingsCurrent = ele.querySelectorAll('.toppingAtCart');
                toppingsCurrent.forEach(topping => {


                    $(topping).click(function () {
                        topping.querySelector('svg').classList.toggle('hidden');
                        if(!(topping.querySelector('svg').classList.contains('hidden'))) {
    
                            let isSelected = completeOrder[index][2].find(element => element == topping.querySelector('.tooping-id').innerHTML);
                            if(isSelected === undefined) {
                                completeOrder[index][2].push(topping.querySelector('.tooping-id').innerHTML);
                            }

                            // ? Searching for the topping price if it is already in the aray
                            let isAddedToppingPrice = toppingPriceByOrder[index].find(element => element == topping.querySelector('.topping-price').innerHTML);
                            if(isAddedToppingPrice === undefined) {
                                toppingPriceByOrder[index].push(topping.querySelector('.topping-price').innerHTML);
                            }

                        } else {
    
                            for(var i = 0; i < completeOrder[index][2].length; i++) {
                                if(completeOrder[index][2][i] == topping.querySelector('.tooping-id').innerHTML) {
                                    completeOrder[index][2].splice(i, 1);
                                }
                            }
                            
                            // ? Removing deselected topping price from toppingPrices array
                            for(var i = 0; i < toppingPriceByOrder[index].length; i++) {
                                if(toppingPriceByOrder[index][i] == topping.querySelector('.topping-price').innerHTML) {
                                    toppingPriceByOrder[index].splice(i, 1);
                                }
                            }

                        }
    
                        topping.classList.toggle('bg-black');
                        topping.classList.toggle('border');
                        topping.classList.toggle('border-gray-300');

                        UpdateTotalPrice();
                    })
                })

                // ? Adding more quantity
                const PlusButton = ele.querySelector(".PlusQuantity");
                $(PlusButton).click(function() {
                    completeOrder[index][1]++;
                    ele.querySelector('.DisplayingQuantity').innerHTML = completeOrder[index][1];
                    UpdateTotalPrice();
                })
                
                
                // ? Reducing quantity
                const MinusButton = ele.querySelector(".MinusQuantity");
                $(MinusButton).click(function() {
                    if(parseInt(completeOrder[index][1]) > 1 ) {
                        completeOrder[index][1]--;
                        ele.querySelector('.DisplayingQuantity').innerHTML = completeOrder[index][1];
                        UpdateTotalPrice();
                    }
                })


            })
        }

        // ? Maintaing Total Price of whole order
        function UpdateTotalPrice() {

            // ? Counting Total Extra Topping Amount of whole Order
            let totalSelectedToppingPrice = 0;
            for (let index = 0; index < toppingPriceByOrder.length; index++) {

                for (let i = 0; i < toppingPriceByOrder[index].length; i++) {

                    totalSelectedToppingPrice = totalSelectedToppingPrice + parseFloat(toppingPriceByOrder[index][i]);
                }

                totalSelectedToppingPrice = totalSelectedToppingPrice * completeOrder[index][1];
            }
            document.querySelector('.totalExtraToppings').innerHTML = `+ Rs.${totalSelectedToppingPrice}`;

            // ? Counting total each price of foods
            let totalPriceEachOrder = 0;
            for (let index = 0; index < EachFoodPriceByOrder.length; index++) {
                totalPriceEachOrder = totalPriceEachOrder + completeOrder[index][1] * EachFoodPriceByOrder[index];
            }

            document.querySelector('.pre-total').innerHTML = "Rs." + totalPriceEachOrder;

            // ? Update Total Price
            let grandTotal = parseFloat(document.querySelector('.pre-total').innerHTML.substr(3)) + totalSelectedToppingPrice;

            if(document.querySelector('.deliveryCharges').innerHTML != '+ Rs.0') {
                document.querySelector('.grandTotal').innerHTML = `Rs.${grandTotal+100}`;
                
                document.querySelector('.amount-button-takeaway').innerHTML = `Rs.${grandTotal+100}`;
                document.querySelector('.amount-button-confirm').innerHTML = `Rs.${grandTotal+100}`;
            } else {
                document.querySelector('.grandTotal').innerHTML = `Rs.${grandTotal}`;
                
                document.querySelector('.amount-button-takeaway').innerHTML = `Rs.${grandTotal}`;
                document.querySelector('.amount-button-confirm').innerHTML = `Rs.${grandTotal}`;
            }

            
        }


     

        $('#isTakeaway').unbind().click(function() {
                $(".payment").toggleClass("hidden");
                $(".total-container").toggleClass("mt-14");
                $("#onlinePay").toggleClass("hidden");
                $("#onlinePay").toggleClass("flex");
    
                $("#confirmTakeaway").toggleClass("hidden");
                $("#confirmTakeaway").toggleClass("flex");
    
                if(document.querySelector('.deliveryCharges').innerHTML == "+ Rs.0") {
                    document.querySelector('.deliveryCharges').innerHTML = "+ Rs.100";
                } else {
                    console.log('Here');
                    document.querySelector('.deliveryCharges').innerHTML = "+ Rs.0";
                }
                // console.log(document.querySelector('.deliveryCharges'));
                UpdateTotalPrice();
        })
    

        $("#confirmTakeaway").unbind().click(function(e) {
            e.preventDefault();
            let deliveryCharges = 0.0;
            if(document.querySelector('.deliveryCharges').innerHTML == "+ Rs.100") {
                deliveryCharges = 100.00;
            }

            const sessionId = document.querySelector('.sessionId').innerHTML;

            const form_data = new FormData();
            form_data.append('sessionId', sessionId);
            form_data.append('deliverycharges', deliveryCharges);
            form_data.append('finalOrder', JSON.stringify(completeOrder));
            $.ajax({
                url: 'operations/take-away-order.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response);
                    clearCartData();
                    updateCartCounter();

                    $(".customize-menu").addClass("scale-0");
                    window.location.replace("foodMain.php");
                }
            });
            console.log("Call me Once");
            console.log(completeOrder);
        })
}

let finalOrder = [];

window.setToppingsAtCart = function (order) {
    finalOrder = [...finalOrder, order];
}

window.getFinalOrder = function () {
    return finalOrder;
}
