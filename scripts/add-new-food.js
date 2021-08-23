$(document).ready(function() {
    toggleText = true;
    $("#AddKitchen").click(function() {
        
        $(".kitchen-form-container").load("operations/get-kitchen-data.php", {}, function() {
            KitchenLisener();
        });
    })

    

    window.KitchenLisener = function () {

        
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
        let selectedIdIngredientsToppings = [];
        let quantityList = [];
        // let selectedIdIngredientsFromSingle = [];
        // let selectedIdIngredientsFromAll = [];
        let renderSelected = [];
        let renderSelectedList = [];
        let selectingElement = []
        

        $("#searchIngredientNames").keyup(function() {
            
            let value = $(this).val();
            if(value !== '') {
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
            }
            
        })

        $("#searchIngredientNamesOnTopping").keyup(function() {
            document.querySelector('.selectedTextTopping').classList.remove('hidden');
            let value = $(this).val();
            if(value !== '') {
                console.log(value);
                $(".topping-list-ingredient").load("operations/get-required-ingredients-exists.php", {
                    query: value,
                    alreadyAdded: JSON.stringify(selectedIdIngredientsToppings)
                }, function() {
                    const parentToppingResults = document.querySelector('.topping-list-ingredient');
                    const ingredientResultsForToppings = parentToppingResults.querySelectorAll('.resulted-ingredients');
                    // selectedIdIngredients = selctedIngredients(ingredientResults);
                    // selctedIngredients(ingredientResults);
                    selectedIngredientonTopping(ingredientResultsForToppings);
                    // selectedIdIngredients = selectedIdIngredients.concat(testArray);
                });
            }
            
        })

        $("#FoodInsert").click(function() {
            selectedIdIngredients.forEach((ele, index) => {
                console.log("Value : ", ele);
            })
            console.log("\n");
            
        })


        // ? Creating Topping
        let successTopping = false;
        $("#InsertTopping").click(function(e) {
            e.preventDefault();
            selectedIdIngredientsToppings.forEach((ele, index) => {
                console.log("ID : ", ele);
            })
            
            quantityList.forEach((ele, index) => {
                console.log("Quantity : ", ele);
            })
            console.log("\n");


            if(quantityList.length == 0 && selectedIdIngredientsToppings.length == 0) {
                setErrorOnInputs(document.querySelector('#SelectedIngredientNameDisabled'),true);
                setErrorOnInputs(document.querySelector("#IngredientQuantityTopping"),true);
            } else if(!successTopping){
                validateToppingFirstForm(document.querySelector('#CreateToppingName'));
                validateToppingFirstForm(document.querySelector('#ToppingPrice'));
            } else {
                console.log("Good to go");

        
                const form_data = new FormData();
        
                const toppingName = $("#CreateToppingName").val();
                const unitPrice = $("#ToppingPrice").val();
                
                $(".inventory-error-message").addClass("hidden");
    
                form_data.append('toppingName', toppingName);
                form_data.append('unitprice', unitPrice);
                form_data.append('ingredientIds', JSON.stringify(selectedIdIngredientsToppings));
                form_data.append('quantityList', JSON.stringify(quantityList));
                
                $.ajax({
                    url: 'operations/add-new-topping.php',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response);
                        // ? After Success
                        document.querySelector('.ingredient-list-food').classList.toggle('hidden');
                        document.querySelector('.ingredient-list-food').classList.toggle('flex');
                        if(!createToppingToggle) {
                            $('.text-change-creating-topping').html("Creating");
                        } else {
                            $('.text-change-creating-topping').html("Create");
                        }
                        $(this).toggleClass('text-green-500')
                        $(this).toggleClass('bg-green-200')
                        $(this).toggleClass('bg-yellow-200')
                        $(this).toggleClass('text-yellow-500')
                        
                        $(this).toggleClass('hover:bg-green-400')
                        $(this).toggleClass('hover:bg-yellow-400')
                        document.querySelector('.creating-a-topping').classList.toggle('hidden')
                        document.querySelector('.creating-a-topping').classList.toggle('flex')
                    }
                });
                
            }
        })


        let createToppingToggle = false;
        $("#ToppingAdd").click(function() {
            document.querySelector('.ingredient-list-food').classList.toggle('hidden');
            document.querySelector('.ingredient-list-food').classList.toggle('flex');
            console.log('trigg');
            if(!createToppingToggle) {
                $('.text-change-creating-topping').html("Creating");
            } else {
                $('.text-change-creating-topping').html("Create");
            }
            $(this).toggleClass('text-green-500')
            $(this).toggleClass('bg-green-200')
            $(this).toggleClass('bg-yellow-200')
            $(this).toggleClass('text-yellow-500')
            
            $(this).toggleClass('hover:bg-green-400')
            $(this).toggleClass('hover:bg-yellow-400')
            document.querySelector('.creating-a-topping').classList.toggle('hidden')
            document.querySelector('.creating-a-topping').classList.toggle('flex')
        })

        ListenOnInputChangesTopping(document.querySelector('#CreateToppingName'));
        ListenOnInputChangesTopping(document.querySelector('#ToppingPrice'));
        ListenOnInputChangesTopping(document.querySelector('#IngredientQuantityTopping'));

        let success = false;
        $("#AddtoListIngredient").click(function() {
            validateAddtoList(document.querySelector("#SelectedIngredientNameDisabled"));
            validateAddtoList(document.querySelector("#IngredientQuantityTopping"));
            if(!success) {
                console.log('Cant move');
            }else {
                console.log('Her we go');
                $(".selectedList").removeClass('hidden');
                quantityList.push(document.querySelector('#IngredientQuantityTopping').value);
                document.querySelector("#SelectedIngredientNameDisabled").value = '';
                document.querySelector('#IngredientQuantityTopping').value = '';

                renderList(selectingElement);
            }
        })

        function renderList(List) {
            List.forEach((ele, index) => {
                let alreadyAdded = renderSelectedList.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                if(alreadyAdded === undefined){
                    renderSelectedList.push(ele);
                    added = true;
                } else {
                    // ? If need to slice
                }

                renderSelectedList.forEach((ele, index) => {

                    document.querySelector('.ingredient-list-topping-selected').appendChild(ele);

                    let alreadyAdded = selectedIdIngredientsToppings.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                    if(alreadyAdded === undefined) {
                        console.log('Pushing T \n');
                        ele.classList.remove('bg-red-400')
                        ele.classList.add('bg-green-400')
                        selectedIdIngredientsToppings.push(ele.querySelector('.selectedIngredientId').innerHTML);
                        addedId = false;
                    }
                    
                    if(addedId) {
                    }
                })
            });
        }

        function validateAddtoList(ele) {
            if(ele.id === `SelectedIngredientNameDisabled` && ele.value === '') {
                setErrorOnInputs(ele,true)
                success = false;
            }else if(ele.id !== `SelectedIngredientNameDisabled` && ele.value <= 0 || ele.value.length === 0) {
                setErrorOnInputs(ele,true)
                success = false;
            }else if(ele.id !== `SelectedIngredientNameDisabled` && ele.value === 0) {
                setErrorOnInputs(ele,true)
                success = false;
            }else {
                setErrorOnInputs(ele,false)
                success = true;
            }
        }


        function validateToppingFirstForm(ele) {
            if(ele.id === `CreateToppingName` && ele.value === '') {
                setErrorOnInputs(ele,true)
                successTopping = false;
            }else if(ele.id !== `CreateToppingName` && ele.value <= 0 || ele.value.length === 0) {
                setErrorOnInputs(ele,true)
                successTopping = false;
            }else if(ele.id !== `CreateToppingName` && ele.value === 0) {
                setErrorOnInputs(ele,true)
                successTopping = false;
            }else {
                setErrorOnInputs(ele,false)
                successTopping = true;
            }
        }

        


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
            let added = false;
            let addedId = false;
            ingredientResults.forEach((ele, index) => {
                $(ele).click(function() {
                    document.querySelector('.selectedText').classList.remove('hidden');
                    document.querySelector('.selectedText').classList.add('flex');
                    ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                    if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                        
                        let alreadyAdded = renderSelected.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                        if(alreadyAdded === undefined){
                            renderSelected.push(ele)
                            added = true;
                        }
                        // console.log(alreadyAdded);
                    } else {

                            added = false;
                            addedId = true;
                            // }

                            for(var i = 0; i < renderSelected.length; i++) {
                                if(renderSelected[i].querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    renderSelected.splice(i, 1);
                                }
                            }


                            for(var i = 0; i < selectedIdIngredients.length; i++) {
                                if(selectedIdIngredients[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    selectedIdIngredients.splice(i, 1);
                                }
                            }

                            ele.classList.remove('bg-green-400')
                            ele.classList.add('bg-red-400')
                            console.log('Popping \n');
                        // }

                    }

                    
                    renderSelected.forEach((ele, index) => {

                        document.querySelector('.ingredient-list-food-selected').appendChild(ele);

                        let alreadyAdded = selectedIdIngredients.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                        if(alreadyAdded === undefined) {
                            console.log('Pushing \n');
                            ele.classList.remove('bg-red-400')
                            ele.classList.add('bg-green-400')
                            selectedIdIngredients.push(ele.querySelector('.selectedIngredientId').innerHTML);
                            addedId = false;
                        }
                        
                        if(addedId) {
                            // selectedIdIngredients.pop();
                        }
                    })
                })
            });
        }


        window.selectedIngredientonTopping = function (ingredientResults) {
            let added = false;
            let addedId = false;
            ingredientResults.forEach((ele, index) => {
                $(ele).click(function() {
                    ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                    // console.log(ele.querySelector('.isSelectedIngredient').classList);
                    if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                        
                        // let alreadyAdded = renderSelected.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                        // if(alreadyAdded === undefined){
                        //     renderSelected.push(ele)
                        //     added = true;
                        // }

                        document.querySelector("#SelectedIngredientNameDisabled").value = ele.querySelector('.ingredient-name').innerHTML;
                        document.querySelector('#IngredientQuantityTopping').value = '';
                        selectingElement.push(ele);
                        setErrorOnInputs(document.querySelector("#SelectedIngredientNameDisabled"),false)
                        document.querySelector('#searchIngredientNamesOnTopping').value = '';
                        document.querySelector('.selectedTextTopping').classList.add('hidden');
                        // console.log(alreadyAdded);
                    } else {

                        console.log("It goes here");
                            // added = false;
                            // addedId = true;

                            // for(var i = 0; i < renderSelected.length; i++) {
                            //     if(renderSelected[i].querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML) {
                            //         renderSelected.splice(i, 1);
                            //     }
                            // }


                            // for(var i = 0; i < selectedIdIngredients.length; i++) {
                            //     if(selectedIdIngredients[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                            //         selectedIdIngredients.splice(i, 1);
                            //     }
                            // }

                            // ele.classList.remove('bg-green-400')
                            // ele.classList.add('bg-red-400')
                            // console.log('Popping \n');

                    }

                    
                    // renderSelected.forEach((ele, index) => {

                    //     document.querySelector('.ingredient-list-food-selected').appendChild(ele);

                    //     let alreadyAdded = selectedIdIngredients.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                    //     if(alreadyAdded === undefined) {
                    //         console.log('Pushing \n');
                    //         ele.classList.remove('bg-red-400')
                    //         ele.classList.add('bg-green-400')
                    //         selectedIdIngredients.push(ele.querySelector('.selectedIngredientId').innerHTML);
                    //         addedId = false;
                    //     }
                        
                    //     if(addedId) {
                    //     }
                    // })


                })
            });
        }
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

// window.isFutureDate = function (currentDate){
//     dateReg = /(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/]201[4-9]|20[2-9][0-9]/;
//     if(!dateReg.test(currentDate)){
//         return true;            
//     }
//     var today = new Date().getTime(),
//     currentDate = currentDate.split("-");

//     // console.log("currentDate" ,currentDate);

//     currentDate = new Date(currentDate[0], currentDate[1] - 1, currentDate[2]).getTime();
//     return (today - currentDate) < 0;
// }

window.ListenOnInputChangesTopping = function (ele) {
    ele.addEventListener('keyup', () => {
        console.log(ele.value);
        if(ele.id === `CreateToppingName` && validateSpecialCharacters(ele.value)) {
            setErrorOnInputs(ele,true)
        }else if(ele.id !== `CreateToppingName` && ele.value <= 0 || ele.value.length === 0) {
            setErrorOnInputs(ele,true)
        }else if(ele.id !== `CreateToppingName` && ele.value === 0) {
            setErrorOnInputs(ele,true)
        }else {
            setErrorOnInputs(ele,false)
        }
    })
}