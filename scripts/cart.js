$(document).ready(function() {

    let completeOrder = [];

    $("#Cart").click(function() {
        $(".checkout-menu").removeClass("scale-0");
        $("body").addClass("overflow-hidden");

        

        completeOrder = getCartData();

        if(completeOrder.length == 0) {
            const CartEmpty = `
            
            <div class="w-full h-full flex items-center justify-center">
            <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Cart is empty.</h1>
        </div>`;

            document.querySelector('.cart-header').innerHTML = CartEmpty;
        } else {
            $(".cart-cards").load("operations/get-card-cards.php", {
                completeOrder: JSON.stringify(completeOrder),
            }, function() {
            })
        }


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