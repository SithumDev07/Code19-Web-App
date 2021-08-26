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
            $(".popupmenu").removeClass('scale-0');
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
            // listenOnProceed();
            listenOnProceed();
        })

        $("#takeAway").click(function(e) {
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
                    $(".customize-menu").addClass("scale-0");
                    window.location.replace("foodMain.php");
                }
            });
        })
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