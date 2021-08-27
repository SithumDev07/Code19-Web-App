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
            }, function(response) {
                const cartCards = document.querySelectorAll('.cart-card');
                CartCardHandler(cartCards);
                var $resData = $(response);
                // alert($resData);
                document.querySelector('.amount-button').innerHTML = $resData.filter("#totalPriceRes").text();
            })
        }

        // ? Handling all removing and adding parts of single cart card
        function CartCardHandler(List) {
            List.forEach(ele => {
                let remove = ele.querySelector('#CartCardRemove');
                $(remove).click(function (){
                    console.log(ele.querySelector('.food-name').innerHTML);
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