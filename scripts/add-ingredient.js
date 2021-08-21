$(document).ready(function() {
    toggleText = true;
    $("#AddIngredient").click(function() {
        
        $(".inventory-form-container").load("operations/get-inventory-data.php", {}, function() {
            InventoryLisener();
        });
    })


    window.InventoryLisener = function () {

        var date = new Date();
        var currentDate = date.toISOString().substring(0,10);
        console.log(currentDate);

        const Manufacture = document.querySelector('#inventoryMFD')
        const Expire = document.querySelector('#inventoryEXP')
        const Purchase = document.querySelector('#inventoryPurchase')

        Manufacture.value = currentDate;
        Expire.value = currentDate;
        Purchase.value = currentDate;

        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        if(toggleText) {
            document.querySelector('.change-text-inventory').innerHTML = "Cancel";
        } else {
            document.querySelector('.change-text-inventory').innerHTML = "Add Ingredient";
        }
        toggleText = !toggleText;
        document.querySelector('.add-inventory-form').classList.toggle('hidden');
        document.querySelector('.add-inventory-form').classList.toggle('flex');
        document.querySelector('.inventory-form-container').classList.toggle('hidden');
        document.querySelector('.inventory-form-container').classList.toggle('block');
        console.log('Working inventory');
    }
})