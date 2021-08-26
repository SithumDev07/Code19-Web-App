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
                customizeMenuHandler(foodId);
            })
        })
    })
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
    }

    function listenOnProceed() {
        if(proceedCheck !== 0) {
            document.querySelector("#GoCheckout").removeAttribute('disabled');
        } else {
            document.querySelector("#GoCheckout").setAttribute('disabled', '');
        }
    }
})