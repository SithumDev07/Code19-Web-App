let foodCards = document.querySelectorAll('.card-food');

$(document).ready(function() {
    let foodId;
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
        $("#CloseCustomMenu").click(function() {
            $(".customize-menu").addClass("scale-0");
            $("body").removeClass("overflow-hidden");
        })
    }
})