
$(document).ready(function() {
    toggleText = true;
    $("#ToppingAdd").click(function() {
        console.log('trigg');
        $(this).toggleClass('text-green-500')
        $(this).toggleClass('bg-green-200')
        $(this).toggleClass('bg-yellow-200')
        $(this).toggleClass('text-yellow-500')
        document.querySelector('.creating-a-topping').classList.toggle('hidden')
        document.querySelector('.creating-a-topping').classList.toggle('flex')
    })

    window.ToppingLisener = function () {

        
        var date = new Date();
        var currentDate = date.toISOString().substring(0,10);
        // console.log(currentDate);
        
        const Manufacture = document.querySelector('#IngredientMFD')
        const Expire = document.querySelector('#IngredientEXP')
        const Purchase = document.querySelector('#IngredientPurchase')
        
        ListenOnInputChangesInventory(document.querySelector('#IngredientName'), 'Ingredient');
        ListenOnInputChangesInventory(document.querySelector('#IngredientCost'), 'Ingredient');
        ListenOnInputChangesInventory(document.querySelector('#IngredientQuantity'), 'Ingredient');

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

        let selectedIdIngredient = 0;

        $("#IngredientName").keyup(function() {
            let value = $(this).val();
            if(value !== '') {
                $(".ingredients-exists").load("operations/get-ingredients-exists.php", {
                    query: value,
                }, function() {
                    selectedIdIngredient = getSelectedIngredientId();
                });
            }
        })


        $("#InsertIngredient").click(function(e) {
            e.preventDefault();

            // const form = document.querySelector('#crew-form');
            const form_data = new FormData();
    
            const name = $("#IngredientName").val();
            const supplier = $("#inventorySupplier").val();
            const cost = $("#IngredientCost").val();
            const paid = $("#isPaidInventory").is(":checked");
            const quantity = $("#IngredientQuantity").val();
            const mfd = $("#IngredientMFD").val();
            const exp = $("#IngredientEXP").val();
            const metric = $("#inventoryMetricType").val();
            const purchaseDate = $("#IngredientPurchase").val();
    
            toggleText = true;
            if(!(validateIngredients(name, cost, quantity, purchaseDate, mfd, exp, 'Ingredient'))) {
                console.log('Not Validated');
                // console.log(paid);
                // console.log("Selected", selectedIdIngredient);
                $(".inventory-error-message").removeClass("hidden");
            } else {
                $(".inventory-error-message").addClass("hidden");
    
                form_data.append('name', name);
                form_data.append('supplier', supplier);
                form_data.append('cost', cost);
                form_data.append('paid', paid);
                form_data.append('quantity', quantity);
                form_data.append('mfd', mfd);
                form_data.append('exp', exp);
                form_data.append('purchaseDate', purchaseDate);
                form_data.append('metric', metric);
                form_data.append('selectedIngredient', selectedIdIngredient);
                $.ajax({
                    url: 'operations/add-new-ingredient.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
                        if(toggleText) {
                            document.querySelector('.change-text-inventory').innerHTML = "Cancel";
                        } else {
                            document.querySelector('.change-text-inventory').innerHTML = "Add Ingredient";
                        }
                        toggleText = !toggleText;
                        document.querySelector('.inventory-form-container').classList.toggle('hidden');
                        document.querySelector('.inventory-form-container').classList.toggle('flex');
                        location.reload();
                    }
                });
            }
        })
    }
})


// let selectedIdIngredient;
window.getSelectedIngredientId = function() {
    if(document.querySelector('#SelectedIngredientId') !== null) {
        let selectedIdIngredient = document.querySelector('#SelectedIngredientId').innerHTML;
        return selectedIdIngredient;
    }

    return 0;
}


window.validateIngredients = function (name, cost, quantity, purchaseDate, Manufacture, Expireation, type) {
    let success = true;

    if(name.length === 0) {
        setErrorOnInputs(document.querySelector(`#${type}Name`),true)
        success = false;
    }else if(validateSpecialCharacters(name)) {
        setErrorOnInputs(document.querySelector(`#${type}Name`),true)
        success=false;
    }


    if(cost != undefined) {
        if(cost.length === 0) {
            setErrorOnInputs(document.querySelector(`#${type}Cost`),true)
            success = false;
        } else if(cost <= 0) {
            setErrorOnInputs(document.querySelector(`#${type}Cost`),true)
            success = false;
        }
    }
    
    if(quantity != undefined) {
        if(quantity.length === 0) {
            setErrorOnInputs(document.querySelector(`#${type}Quantity`),true)
            success = false;
        } else if(quantity <= 0) {
            setErrorOnInputs(document.querySelector(`#${type}Quantity`),true)
            success = false;
        }
    }

    console.log(isFutureDate(purchaseDate));

    if(purchaseDate != undefined) {
        if(isFutureDate(purchaseDate)) {
            setErrorOnInputs(document.querySelector(`#${type}Purchase`),true)
            success = false;
        } else {
            setErrorOnInputs(document.querySelector(`#${type}Purchase`),false)
        }
    }

    if(Manufacture != undefined) {
        if(isFutureDate(Manufacture)) {
            setErrorOnInputs(document.querySelector(`#${type}MFD`),true)
            success = false;
        } else {
            setErrorOnInputs(document.querySelector(`#${type}MFD`),false)
        }
    }

    if(Expireation != undefined) {
        if(!isFutureDate(Expireation)) {
            setErrorOnInputs(document.querySelector(`#${type}EXP`),true)
            success = false;
        } else {
            setErrorOnInputs(document.querySelector(`#${type}EXP`),false)
        }
    }

    

    if(success){

    }

    return success;
    // return false;
}

window.isFutureDate = function (currentDate){
    dateReg = /(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/]201[4-9]|20[2-9][0-9]/;
    if(!dateReg.test(currentDate)){
        return true;            
    }
    var today = new Date().getTime(),
    currentDate = currentDate.split("-");

    // console.log("currentDate" ,currentDate);

    currentDate = new Date(currentDate[0], currentDate[1] - 1, currentDate[2]).getTime();
    return (today - currentDate) < 0;
}

window.ListenOnInputChangesInventory = function (ele, specificInput) {
    ele.addEventListener('keyup', () => {
        console.log(ele.value);
        if(ele.id === `${specificInput}Name` && validateSpecialCharacters(ele.value)) {
            setErrorOnInputs(ele,true)
        }else if(ele.id !== `${specificInput}Name` && ele.value <= 0 || ele.value.length === 0) {
            setErrorOnInputs(ele,true)
        }else if(ele.id !== `${specificInput}Name` && ele.value === 0) {
            setErrorOnInputs(ele,true)
        }else {
            setErrorOnInputs(ele,false)
        }
    })
}