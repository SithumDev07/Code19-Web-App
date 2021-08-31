$(document).ready(function() {

    handleOrderList();

    $("#orderViewCancel").click(function() {
        $(".single-order-container").toggleClass('hidden');
        $(".single-order-container").toggleClass('flex');
        $("#stickyContainer").removeClass('overflow-y-hidden');

        $(".after-orders-loader").load("operations/get-order-status.php", {
        }, function() {
            handleOrderList();
        })
    })


    function handleOrderList() {
        const singleOrders = document.querySelectorAll('.single-order');
        singleOrders.forEach((ele, index) => {
            $(ele).click(function() {
                $(".single-order-container").removeClass('hidden');
                $(".single-order-container").addClass('flex');
                $("#orderViewCancel").removeClass('hidden');
                $("#orderViewCancel").addClass('flex');
    
                $("#stickyContainer").addClass('overflow-y-hidden');
                document.querySelector('#stickyContainer').scrollTop = 0;
        
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
    
                        // ? Update the status of order
                        const form_data = new FormData();
                        form_data.append('id', orderId);
                        form_data.append('status', 'Processing');
                        $.ajax({
                            url: 'operations/set-status-of-order.php',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function(response) {
            
                                alert(response);
                            }
                        });
                    })
    
    
                    $("#HoldOrder").click(function() {
    
                        $("#HoldOrder").addClass('animate-ping');
                        $("#Delivered").removeClass('animate-ping');
                        $("#Delivered").removeClass('ml-5');
                        $("#Delivered").addClass('ml-3');
                        $("#HoldOrder").addClass('mr-5');
    
                        // ? Update the status of order
                        const form_data = new FormData();
                        form_data.append('id', orderId);
                        form_data.append('status', 'On Hold');
                        $.ajax({
                            url: 'operations/set-status-of-order.php',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function(response) {
            
                                alert(response);
                            }
                        });
                    })
    
    
                    $("#Delivered").click(function() {
    
                        $("#Delivered").addClass('animate-ping');
                        $("#HoldOrder").removeClass('animate-ping');
                        $("#HoldOrder").removeClass('ml-5');
                        $("#HoldOrder").addClass('mr-3');
                        $("#Delivered").addClass('ml-5');
    
                        // ? Update the status of order
                        const form_data = new FormData();
                        form_data.append('id', orderId);
                        form_data.append('status', 'Delivering');
                        $.ajax({
                            url: 'operations/set-status-of-order.php',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function(response) {
            
                                alert(response);
                            }
                        });
                    })
                    
                    function removeAcceptButton() {
                        $("#AcceptOrder").removeClass('flex');
                        $("#AcceptOrder").addClass('hidden');
                    }
    
                    
                })
            })
        })
    }

    
})