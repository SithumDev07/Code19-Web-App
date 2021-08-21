let ingredientCards = document.querySelectorAll('.card-inventory');

$(document).ready(function() {
    let ingredientId;
    ingredientCards.forEach((ele, index) => {
        $(ele).click(function() {
            ingredientId = ele.querySelector('.card-inventory-id').innerHTML;
            console.log("Id: " ,ingredientId);
            $(".inventory-form-container").load("operations/get-card-inventory-data.php", {
                id: ingredientId,
            }, function() {
                DeleteListenerInventory();
            })
        })
    })


    toggleText = true;
    function DeleteListenerInventory() {
        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        if(toggleText) {
            document.querySelector('.change-text-inventory').innerHTML = "Cancel";
        } else {
            document.querySelector('.change-text-inventory').innerHTML = "Add Supplier";
        }
        toggleText = !toggleText;
        document.querySelector('.add-inventory-form').classList.toggle('hidden');
        document.querySelector('.add-inventory-form').classList.toggle('flex');
        document.querySelector('.inventory-form-container').classList.toggle('hidden');
        document.querySelector('.inventory-form-container').classList.toggle('block');
        console.log('Working Updated inventory');

        $("#DeleteIngredient").click(function() {
            console.log('Deleting inventory');

            toggleText = true;
        
            const form_data = new FormData();
            const IngredientIdSelected = $("#IngredientId").val();
            form_data.append('id', IngredientIdSelected);
            console.log("Selected Id: ",IngredientIdSelected);
            $.ajax({
                url: 'operations/delete-ingredient.php',
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        })
    }
})