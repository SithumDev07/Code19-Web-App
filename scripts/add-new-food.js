$(document).ready(function() {
    toggleText = true;
    $("#AddKitchen").click(function() {
        
        $(".kitchen-form-container").load("operations/get-kitchen-data.php", {}, function() {
            InventoryLisener();
        });
    })

    

    window.InventoryLisener = function () {

        
        // ListenOnInputChangesInventory(document.querySelector('#IngredientName'), 'Ingredient');
        // ListenOnInputChangesInventory(document.querySelector('#IngredientCost'), 'Ingredient');
        // ListenOnInputChangesInventory(document.querySelector('#IngredientQuantity'), 'Ingredient');

        

        document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        if(toggleText) {
            document.querySelector('.change-text-kitchen').innerHTML = "Cancel";
        } else {
            document.querySelector('.change-text-kitchen').innerHTML = "Add Food";
        }
        toggleText = !toggleText;
        document.querySelector('.add-kitchen-form').classList.toggle('hidden');
        document.querySelector('.add-kitchen-form').classList.toggle('flex');
        document.querySelector('.kitchen-form-container').classList.toggle('hidden');
        document.querySelector('.kitchen-form-container').classList.toggle('block');
        console.log('Working kitchen');

        let selectedIdIngredients = [];
        let unique = [];
        // let selectedIdIngredientsFromSingle = [];
        // let selectedIdIngredientsFromAll = [];
        let renderSelected = [];
        

        $("#searchIngredientNames").keyup(function() {
            let value = $(this).val();
            if(value !== '') {
                // console.log('Trigger Here');
                $(".ingredient-list-food ").load("operations/get-required-ingredients-exists.php", {
                    query: value,
                    alreadyAdded: JSON.stringify(selectedIdIngredients)
                }, function() {
                    let testArray = [];
                    const ingredientResults = document.querySelectorAll('.resulted-ingredients');
                    // selectedIdIngredients = selctedIngredients(ingredientResults);
                    selctedIngredients(ingredientResults);
                    // selectedIdIngredients = selectedIdIngredients.concat(testArray);
                });
            } else {
                // console.log('Trigger Here True');
                // $(".ingredient-list-food ").load("operations/get-required-ingredients-exists-all.php", {
                //     query: 'unset',
                // }, function() {
                //     const ingredientResults = document.querySelectorAll('.resulted-ingredients');
                //     // selectedIdIngredients = selctedIngredients(ingredientResults);
                //     selctedIngredients(ingredientResults);
                // });
            }

            // uniq = [...new Set(renderSelected)];
            
        })

        $("#FoodInsert").click(function() {
            // console.log('Triggering');
            selectedIdIngredients.forEach((ele, index) => {
                console.log("Value : ", ele);
            })
            console.log("\n");
            
        })


        // $("#InsertIngredient").click(function(e) {
        //     e.preventDefault();

        //     // const form = document.querySelector('#crew-form');
        //     const form_data = new FormData();
    
        //     const name = $("#IngredientName").val();
        //     const supplier = $("#inventorySupplier").val();
        //     const cost = $("#IngredientCost").val();
        //     const paid = $("#isPaidInventory").is(":checked");
        //     const quantity = $("#IngredientQuantity").val();
        //     const mfd = $("#IngredientMFD").val();
        //     const exp = $("#IngredientEXP").val();
        //     const metric = $("#inventoryMetricType").val();
        //     const purchaseDate = $("#IngredientPurchase").val();
    
        //     toggleText = true;
        //     if(!(validateIngredients(name, cost, quantity, purchaseDate, mfd, exp, 'Ingredient'))) {
        //         console.log('Not Validated');
        //         // console.log(paid);
        //         // console.log("Selected", selectedIdIngredient);
        //         $(".inventory-error-message").removeClass("hidden");
        //     } else {
        //         $(".inventory-error-message").addClass("hidden");
    
        //         form_data.append('name', name);
        //         form_data.append('supplier', supplier);
        //         form_data.append('cost', cost);
        //         form_data.append('paid', paid);
        //         form_data.append('quantity', quantity);
        //         form_data.append('mfd', mfd);
        //         form_data.append('exp', exp);
        //         form_data.append('purchaseDate', purchaseDate);
        //         form_data.append('metric', metric);
        //         form_data.append('selectedIngredient', selectedIdIngredient);
        //         $.ajax({
        //             url: 'operations/add-new-ingredient.php',
        //             type: 'POST',
        //             data: form_data,
        //             contentType: false,
        //             processData: false,
        //             success: function(response) {
        //                 alert(response);
        //                 document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        //                 if(toggleText) {
        //                     document.querySelector('.change-text-inventory').innerHTML = "Cancel";
        //                 } else {
        //                     document.querySelector('.change-text-inventory').innerHTML = "Add Ingredient";
        //                 }
        //                 toggleText = !toggleText;
        //                 document.querySelector('.inventory-form-container').classList.toggle('hidden');
        //                 document.querySelector('.inventory-form-container').classList.toggle('flex');
        //                 location.reload();
        //             }
        //         });
        //     }
        window.selctedIngredients = function (ingredientResults) {
            // let selectedIngredientArray = [];
            let added = false;
            ingredientResults.forEach((ele, index) => {
                $(ele).click(function() {
                    ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                    if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                        // selectedIdIngredients.push(ele.querySelector('.selectedIngredientId').innerHTML);
                        let alreadyAdded = renderSelected.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                        if(alreadyAdded === undefined){
                            renderSelected.push(ele)
                            added = true;
                        }
                        console.log(alreadyAdded);
                    } else {
                        // selectedIdIngredients.pop();
                        if(added) {
                            renderSelected.pop();
                            added = false;
                        }
                    }

                    
                    // unique = renderSelected.filter((item, i, ar) => ar.indexOf(item) === i);
                    
                    renderSelected.forEach((ele, index) => {
                        document.querySelector('.ingredient-list-food-selected').appendChild(ele);


                        let alreadyAdded = selectedIdIngredients.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                        if(alreadyAdded === undefined) {
                            selectedIdIngredients.push(ele.querySelector('.selectedIngredientId').innerHTML)
                        }
                        // console.log(ele.querySelector('.selectedIngredientId').innerHTML);
                    })
                })
                // selectedIngredientArray.forEach((ele, index) => {
                //     console.log(ele);
                // })
            });
            // return selectedIngredientArray;
        }
        // })
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