$(document).ready(function() {
    const singleOrders = document.querySelectorAll('.single-order');
    singleOrders.forEach((ele, index) => {
        $(ele).click(function() {
            $(".single-order-container").toggleClass('hidden');
            $(".single-order-container").toggleClass('flex');
            $("#orderViewCancel").toggleClass('hidden');
            $("#orderViewCancel").toggleClass('flex');
    
            const orderId = ele.querySelector('.order-id').innerHTML.substring(1);
            console.log(orderId);

            
            $(".single-order-container").load("operations/get-single-order.php", {
                orderid: orderId,
            }, function() {
                
                $("#AcceptOrder").click(function() {
                    $("#AcceptOrder").toggleClass('scale-0');
                    setTimeout(removeAcceptButton, 500);
                    $("#HoldOrder").removeClass('scale-0');
                    $("#Delivered").removeClass('scale-0');
                })
                
                function removeAcceptButton() {
                    $("#AcceptOrder").removeClass('flex');
                    $("#AcceptOrder").addClass('hidden');
                }
            })
        })
    })
})