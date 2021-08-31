$(document).ready(function() {
    $(".single-order").click(function() {
        $(".single-order-container").toggleClass('hidden');
        $(".single-order-container").toggleClass('flex');
        $("#orderViewCancel").toggleClass('hidden');
        $("#orderViewCancel").toggleClass('flex');

        const orderId = document.querySelector('.order-id').innerHTML.substring(1);
        console.log(orderId);
    })
})