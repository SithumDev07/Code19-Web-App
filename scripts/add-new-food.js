$(document).ready(function() {
    toggleText = true;
    $("#AddKitchen").click(function() {
        
        $(".kitchen-form-container").load("operations/get-kitchen-data.php", {}, function() {
            KitchenLisener();
        });
    })

    

    window.KitchenLisener = function () {


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
        // console.log('Working kitchen');

        let selectedIdIngredients = [];

        let selectedIdIngredientsToppings = [];
        let selectedIdIngredientsFoods = [];


        let quantityList = [];
        let quantityListFood = [];
        // let selectedIdIngredientsFromSingle = [];
        // let selectedIdIngredientsFromAll = [];
        let renderSelectedList = [];
        let renderSelectedListFood = [];

        let selectingElement = []
        let selectingElementFood = [];

        let selectedToppings = [];

        let renderListToppings = [];
        let selectedToppingIds = [];

        let confirmedIngredientsToppings = [];
        let confirmedIdIngredientsToppings = [];

        let confirmedIngredientsFood = [];
        let confirmedIngredientIdsFood = [];

        let removedList = [];
        let removedListFood = [];
        

        $("#searchIngredientNames").keyup(function() {
            document.querySelector('.selectedTextToppingLast').classList.add('hidden');
            document.querySelector('.selectedTextToppingLast').classList.remove('flex');
            document.querySelector('.ingredient-list-food').classList.remove('hidden');
            document.querySelector('.ingredient-list-food').classList.add('flex');

            document.querySelector('.food-ingredients-inputs').classList.remove('hidden')
            document.querySelector('.food-ingredients-inputs').classList.add('flex')

            document.querySelector('.topic-ingredient-food').classList.remove('hidden')

            
            let value = $(this).val();
            if(value !== '') {
                $(".ingredient-list-food ").load("operations/get-required-ingredients-exists.php", {
                    query: value,
                    alreadyAdded: JSON.stringify(selectedIdIngredientsFoods)
                }, function() {
                    let testArray = [];
                    const ingredientResults = document.querySelectorAll('.resulted-ingredients');
                    
                    selctedIngredients(ingredientResults);
                    // selectedIdIngredients = selectedIdIngredients.concat(testArray);
                });
            }
            
        })

        // ? Search Avaliable Ingredients for Toopings
        $("#searchIngredientNamesOnTopping").keyup(function() {
            document.querySelector('.selectedTextTopping').classList.remove('hidden');
            let value = $(this).val();
            if(value !== '') {
                // console.log(value);
                $(".topping-list-ingredient").load("operations/get-required-ingredients-exists.php", {
                    query: value,
                    alreadyAdded: JSON.stringify(selectedIdIngredientsToppings)
                }, function() {
                    const parentToppingResults = document.querySelector('.topping-list-ingredient');
                    const ingredientResultsForToppings = parentToppingResults.querySelectorAll('.resulted-ingredients');
                    
                    selectedIngredientonTopping(ingredientResultsForToppings);
                    // selectedIdIngredients = selectedIdIngredients.concat(testArray);
                });
            }
            
        })


        // ? Search Topping Names
        $("#SearchToppingNames").keyup(function() {
            document.querySelector('.ingredient-list-food').classList.add('hidden');
            document.querySelector('.ingredient-list-food').classList.remove('flex');
            document.querySelector('.selectedTextToppingLast').classList.remove('hidden');
            document.querySelector('.selectedTextToppingLast').classList.add('flex');

            document.querySelector('.topic-ingredient-food').classList.add('hidden');
            document.querySelector('.food-ingredients-inputs').classList.add('hidden');
            document.querySelector('.food-ingredients-inputs').classList.remove('flex');
            let value = $(this).val();
            if(value !== '') {
                // console.log(value);
                $(".topping-list").load("operations/get-required-toppings-exists.php", {
                    query: value,
                    alreadyAdded: JSON.stringify(selectedToppings)
                }, function() {
                    const parentToppingResults = document.querySelector('.topping-list');
                    const ResultsForToppings = parentToppingResults.querySelectorAll('.resulted-ingredients');
                    selctedToppings(ResultsForToppings);
                });
            }
            
        })

        // ? Food Name render on card
        $("#foodName").keyup(function() {
        
            let value = $(this).val();
            if(value !== '') {
                document.querySelector('.card-foodName').innerHTML = value;
            } else {
                document.querySelector('.card-foodName').innerHTML = 'Sample Food Name';
            }
        })

        // ? Description render on card
        $("#foodDescription").keyup(function() {
        
            let value = $(this).val();
            if(value !== '') {
                document.querySelector('.card-description').innerHTML = value;
            } else {
                document.querySelector('.card-description').innerHTML = 'Sample Food Name';
            }
        })


        // ? Unit Price render on card
        $("#unitPriceFood").keyup(function() {
        
            let value = $(this).val();
            if(value !== '') {
                if(value.includes('.')) {
                    let numberArray = value.split('.');
                    let decimal = numberArray.shift();
                    let points = numberArray.join('.');
                    document.querySelector('.card-basicPrice').innerHTML = "Rs." + decimal + "." + points;
                } else {
                    document.querySelector('.card-basicPrice').innerHTML = "Rs." + value + ".00";
                }
            } else {
                document.querySelector('.card-basicPrice').innerHTML = 'Rs.0.00';
            }
        })

        $("#FoodInsert").click(function() {


            console.log('Swending');
            confirmedIdIngredientsToppings.forEach((ele, index) => {
                console.log('IID -', ele);
            })
            quantityList.forEach((ele, index) => {
                console.log('Quantity -', ele);
            })
            console.log("\n");


            console.log('Sending from food');
            confirmedIngredientIdsFood.forEach((ele, index) => {
                console.log('IID -', ele);
            })
            quantityListFood.forEach((ele, index) => {
                console.log('Quantity -', ele);
            })
            console.log("\n");
            
            console.log('Toppings List - ');
            if(selectedToppingIds.length == 0) {
                console.log('toppings list is empty');
            } else {
                selectedToppingIds.forEach(elemtn => {
                    console.log(elemtn);
                })
            }
            console.log("\n");

            console.log('Removing List Food - ');
            if(removedListFood.length == 0) {
                console.log('removing list is empty');
            } else {
                removedListFood.forEach(elemtn => {
                    console.log(elemtn);
                })
            }
            console.log("\n");

        
            // TODO Inserting Part
            if(confirmedIngredientIdsFood.length > 0 && selectedToppingIds.length > 0) {
                setErrorOnInputs(document.querySelector('#searchIngredientNames'),false);
                setErrorOnInputs(document.querySelector('#SearchToppingNames'),false);
            }

            if(document.querySelector('#foodPhotoUpload').files.length === 0) {
                setErroOnCrewImage(true, document.querySelector('.foodImageContainer'))
                foodInputSuccess = false;
                $(".food-error-message").removeClass("hidden");
            }

            if(!isValidExtention(document.querySelector('#foodPhotoUpload'))) {
                setErroOnCrewImage(true, document.querySelector('.foodImageContainer'))
                foodInputSuccess = false;
            }

            if(!isValidImageSize(document.querySelector('#foodPhotoUpload'))) {
                setErroOnCrewImage(true, document.querySelector('.foodImageContainer'))
                foodInputSuccess=false;
            }

            // ? Most required validations

            if(confirmedIngredientIdsFood.length == 0 || selectedToppingIds.length == 0) {
                setErrorOnInputs(document.querySelector('#searchIngredientNames'),true);
                setErrorOnInputs(document.querySelector('#SearchToppingNames'),true);
                foodInputSuccess = false;
                $(".food-error-message").removeClass("hidden");
            } 
             else {
                validateFoodDetils(document.querySelector('#foodName'));
                validateFoodDetils(document.querySelector('#foodDescription'));
                validateFoodDetils(document.querySelector('#unitPriceFood'));
                validateFoodDetils(document.querySelector('#foodPrepTime'));

                setErrorOnInputs(document.querySelector('#searchIngredientNames'),false);
                setErrorOnInputs(document.querySelector('#SearchToppingNames'),false);
                if(foodInputSuccess) {
                    console.log("Done");

            
                    const form_data = new FormData();
                    const image = $("#foodPhotoUpload")[0].files;
                    console.log(image[0]);
            
                    const foodName = $("#foodName").val();
                    const foodDescription = $("#foodDescription").val();
                    const foodBasicPrice = $("#unitPriceFood").val();
                    const foodPrepTime = $("#foodPrepTime").val();
                    
                    $(".food-error-message").addClass("hidden");
        
                    form_data.append('foodname', foodName);
                    form_data.append('fooddescription', foodDescription);
                    form_data.append('basicprice', foodBasicPrice);
                    form_data.append('preptime', foodPrepTime);
                    form_data.append('image', image[0]);
                    form_data.append('ingredientIds', JSON.stringify(confirmedIngredientIdsFood));
                    form_data.append('ingredientQuantities', JSON.stringify(quantityListFood));
                    form_data.append('toppingIds', JSON.stringify(selectedToppingIds));
                    
                    $.ajax({
                        url: 'operations/add-new-food.php',
                        type: 'POST',
                        data: form_data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            alert(response);
                            // ? After Success
                            alert(response);
                            // console.log(response);
                            document.querySelector('.transformin-icon').classList.toggle('translate-icon');
                            if(toggleText) {
                                document.querySelector('.change-text-kitchen').innerHTML = "Cancel";
                            } else {
                                document.querySelector('.change-text-kitchen').innerHTML = "Add Food";
                            }
                            toggleText = !toggleText;
                            document.querySelector('.kitchen-form-container').classList.toggle('hidden');
                            document.querySelector('.kitchen-form-container').classList.toggle('flex');
                            location.reload();
                        }
                    });
                    } else {
                        $(".food-error-message").removeClass("hidden");
                    }
            }
            
        })

        let foodInputSuccess = false;
        function validateFoodDetils(ele) {
            if(ele.id === `foodName` || ele.id === `foodDescription` && ele.value === '') {
                setErrorOnInputs(ele,true)
                foodInputSuccess = false;
            }else if(ele.id !== `foodName` && ele.id !== `foodDescription` && ele.value <= 0 || ele.value.length === 0) {
                setErrorOnInputs(ele,true)
                foodInputSuccess = false;
            }else if(ele.id !== `foodName` && ele.id !== `foodDescription` && ele.value === 0) {
                setErrorOnInputs(ele,true)
                foodInputSuccess = false;
            }else {
                setErrorOnInputs(ele,false)
                foodInputSuccess = true;
            }
        }


        // ? Creating Topping
        let successTopping = false;
        $("#InsertTopping").click(function(e) {
            e.preventDefault();
           

            if(quantityList.length == 0 && confirmedIdIngredientsToppings.length == 0) {
                setErrorOnInputs(document.querySelector('#SelectedIngredientNameDisabled'),true);
                setErrorOnInputs(document.querySelector("#IngredientQuantityTopping"),true);
            } else if(!successTopping){
                validateToppingFirstForm(document.querySelector('#CreateToppingName'));
                validateToppingFirstForm(document.querySelector('#ToppingPrice'));
            } else {
                // console.log("Good to go");

        
                const form_data = new FormData();
        
                const toppingName = $("#CreateToppingName").val();
                const unitPrice = $("#ToppingPrice").val();
                
                $(".inventory-error-message").addClass("hidden");
    
                form_data.append('toppingName', toppingName);
                form_data.append('unitprice', unitPrice);
                form_data.append('ingredientIds', JSON.stringify(confirmedIdIngredientsToppings));
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
                            document.querySelector('.text-change-creating-topping').innerHTML =  "Creating";
                            createToppingToggle = true;
                        } else {
                            document.querySelector('.text-change-creating-topping').innerHTML =  "Create";
                            createToppingToggle = false;
                        }
                        $("#ToppingAdd").toggleClass('text-green-500')
                        $("#ToppingAdd").toggleClass('bg-green-200')
                        $("#ToppingAdd").toggleClass('bg-yellow-200')
                        $("#ToppingAdd").toggleClass('text-yellow-500')
                        
                        $("#ToppingAdd").toggleClass('hover:bg-green-400')
                        $("#ToppingAdd").toggleClass('hover:bg-yellow-400')
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
                document.querySelector('.text-change-creating-topping').innerHTML =  "Creating";
                createToppingToggle = true;
            } else {
                document.querySelector('.text-change-creating-topping').innerHTML =  "Create";
                createToppingToggle = false;
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


        // ? Food Details
        ListenOnInputChangesFood(document.querySelector('#foodName'))
        ListenOnInputChangesFood(document.querySelector('#foodDescription'))
        ListenOnInputChangesFood(document.querySelector('#unitPriceFood'))
        ListenOnInputChangesFood(document.querySelector('#foodPrepTime'))


        // ? Calling Add to listener Event Methods
        // let success = false;
        addToListClickListener($("#AddtoListIngredient"), document.querySelector('#SelectedIngredientNameDisabled'), document.querySelector('#IngredientQuantityTopping'), $(".selectedList"), quantityList, selectingElement, confirmedIngredientsToppings, renderSelectedList, confirmedIdIngredientsToppings, document.querySelector('.ingredient-list-topping-selected'), selectedIdIngredientsToppings, removedList);

        addToListClickListener($("#AddtoListIngredientFood"), document.querySelector('#IngredientNameFoodDisabled'), document.querySelector('#IngredientQuantityFood'), $(".selectedTextFood"), quantityListFood, selectingElementFood, confirmedIngredientsFood, renderSelectedListFood, confirmedIngredientIdsFood, document.querySelector('.ingredient-list-food-selected'), selectedIdIngredientsFoods, removedListFood);

        function addToListClickListener(ele, disabled, quantityInput, hiddenSelectedList, quantityList, currentlySelcted, confirmedSelected, renderSelectedList, confirmIds, renderElContainer, idFilter, removedList) {
            
            $(ele).click(function() {
                if(!validateAddtoList(disabled) || !validateAddtoList(quantityInput)) {
                    console.log("Can't move");
                } else {
                    console.log("here we go");

                    $(hiddenSelectedList).removeClass('hidden');

                    // ? Adding Quantity
                    quantityList.push(quantityInput.value);

                    // ? Getting last clicked ingredient button
                    confirmedSelected.push(currentlySelcted.slice(-1)[0]);
                    

                    quantityInput.value = '';
                    disabled.value = '';

                    renderListCommon(confirmedSelected, renderSelectedList, confirmIds, renderElContainer, idFilter, removedList);

                }
            })
        }

        function renderListCommon(List, renderSelectedList, confirmedIds, renderElContainer, idFilter, removedList) {
           
            List.forEach((ele, index) => {

                let alreadtAdded = renderSelectedList.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                let alreadtOffedList = List.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                

                if(alreadtAdded === undefined) {
                    if(alreadtOffedList !== undefined) {
                        renderSelectedList.push(ele);
                    }
                }

                // ? Checking for already added if no then add to the final list - Sending List
                let isConfirmed = confirmedIds.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                let isRemovingItem = removedList.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                if(isConfirmed === undefined) {
                    if(isRemovingItem === undefined) {
                        confirmedIds.push(ele.querySelector('.selectedIngredientId').innerHTML);
                        ele.classList.remove('bg-red-400');
                        ele.classList.add('bg-green-400');
                    } else {
                    }
                }

                // ? Render on screen method
                renderSelectedList.forEach((ele, index) => {
                    renderElContainer.appendChild(ele);

                    // ? Filtering database SQL Query
                    let alreadyAdded = idFilter.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                    if(alreadyAdded === undefined) {
                        idFilter.push(ele.querySelector('.selectedIngredientId').innerHTML);
                        
                    }

                })
            })
        }

        // ? Interacting with food Ingredients
        window.selctedIngredients = function (ingredientResults) {
            ingredientResults.forEach((ele, index) => {
                $(ele).click(function() {
                    ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                    // document.querySelector('.selectedText').classList.remove('hidden');
                    
                    if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                        
                        document.querySelector('.ingredient-list-food').classList.add('hidden');
                        
                        document.querySelector('#IngredientNameFoodDisabled').value = ele.querySelector('.ingredient-name').innerHTML;

                        document.querySelector('#IngredientQuantityFood').value = '';
                        setErrorOnInputs(document.querySelector("#IngredientNameFoodDisabled"),false)

                        document.querySelector('#searchIngredientNames').value = '';

                       // ? Adding selected items to render on screen

                       selectingElementFood.push(ele);

                       let ifRemoved = removedListFood.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML)
                        console.log('in r food list? -', ifRemoved);
                        if(ifRemoved !== undefined) {
                            for(var i = 0; i < removedListFood.length; i++) {
                                if(removedListFood[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    removedListFood.splice(i, 1);
                                }
                            }
                        }

                        console.log('triggered if');
                    } else {
                        console.log("Triggered Else");

                        // ? Removing selected element

                        let ifRemoved = removedListFood.find(element => element == document.querySelector('.selectedIngredientId').innerHTML)
                        if(ifRemoved === undefined) {
                            removedListFood.push(ele.querySelector('.selectedIngredientId').innerHTML);
                        }

                        for(var i = 0; i < confirmedIngredientIdsFood.length; i++) {
                            if(confirmedIngredientIdsFood[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                // selectingElement.splice(i, 1);

                                console.log('Removing ', ele.querySelector(".ingredient-name").innerHTML, " and id ", i);

                                // ? Also updating sending list confirmed
                                quantityListFood.splice(i, 1);
                                confirmedIngredientIdsFood.splice(i, 1);
                            }
                        }


                        ele.classList.remove('bg-green-400')
                        ele.classList.add('bg-red-400')
                        

                    }
                })
            });
        }




        // ? Ingredient Handler for toppings
        window.selectedIngredientonTopping = function (ingredientResults) {
            ingredientResults.forEach((ele, index) => {
                $(ele).click(function() {
                    ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                    if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                        document.querySelector("#SelectedIngredientNameDisabled").value = ele.querySelector('.ingredient-name').innerHTML;
                        document.querySelector('#IngredientQuantityTopping').value = '';
                        setErrorOnInputs(document.querySelector("#SelectedIngredientNameDisabled"),false)
                        document.querySelector('#searchIngredientNamesOnTopping').value = '';
                        document.querySelector('.selectedTextTopping').classList.add('hidden');

                        // ? Adding selected items to render on screen
                       
                        selectingElement.push(ele);

                        let ifRemoved = removedList.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML)
                        console.log('in r list? -', ifRemoved);
                        if(ifRemoved !== undefined) {
                            for(var i = 0; i < removedList.length; i++) {
                                if(removedList[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    removedList.splice(i, 1);
                                }
                            }
                        }


                        console.log("Trigger If");

                    } else {
                        console.log("Trigger Else");

                        // ? Removing selected element

                        let ifRemoved = removedList.find(element => element == document.querySelector('.selectedIngredientId').innerHTML)
                        if(ifRemoved === undefined) {
                            removedList.push(ele.querySelector('.selectedIngredientId').innerHTML);
                        }

                        for(var i = 0; i < confirmedIdIngredientsToppings.length; i++) {
                            if(confirmedIdIngredientsToppings[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                // selectingElement.splice(i, 1);

                                console.log('Removing ', ele.querySelector(".ingredient-name").innerHTML, " and id ", i);

                                // ? Also updating sending list confirmed
                                quantityList.splice(i, 1);
                                confirmedIdIngredientsToppings.splice(i, 1);
                            }
                        }


                        ele.classList.remove('bg-green-400')
                        ele.classList.add('bg-red-400')
     
                    }
                })
            });
        }


        function validateAddtoList(ele) {
            let success = true;
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

            return success;
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

    

        // ? Interacting with toppings
        window.selctedToppings = function (toppingResults) {
            let added = false;
            let addedId = false;
            toppingResults.forEach((ele, index) => {
                $(ele).click(function() {
                    document.querySelector('.selectedTextToppinss').classList.remove('hidden');
                    document.querySelector('.selectedTextToppinss').classList.add('flex');
                    ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                    if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                        
                        let alreadyAdded = renderListToppings.find(element => element.querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML);
                        if(alreadyAdded === undefined){
                            renderListToppings.push(ele)
                            added = true;
                        }
                    } else {

                            added = false;
                            addedId = true;
                            // }

                            for(var i = 0; i < renderListToppings.length; i++) {
                                if(renderListToppings[i].querySelector('.selectedIngredientId').innerHTML == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    renderListToppings.splice(i, 1);
                                }
                            }


                            for(var i = 0; i < selectedToppingIds.length; i++) {
                                if(selectedIdIngredients[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    selectedToppingIds.splice(i, 1);
                                }
                            }

                            ele.classList.remove('bg-green-400')
                            ele.classList.add('bg-red-400')
                        // }

                    }

                    
                    renderListToppings.forEach((ele, index) => {

                        document.querySelector('.toppingss-list-food-selected').appendChild(ele);

                        let alreadyAdded = selectedToppingIds.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                        if(alreadyAdded === undefined) {
                            // console.log('Pushing \n');
                            ele.classList.remove('bg-red-400')
                            ele.classList.add('bg-green-400')
                            selectedToppingIds.push(ele.querySelector('.selectedIngredientId').innerHTML);
                            addedId = false;
                        }
                        
                        if(addedId) {
                        }
                    })
                })
            });
        }


        
        $(function(){
       
            $('#foodPhotoUpload').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                 {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $(".foodImageContainer").removeClass("border-blue-600")
                        $(".foodImageContainer").removeClass("border-red-500")
                        $(".foodImageContainer").addClass("border-green-500")
                       $('#foodUploadedPhoto').attr('src', e.target.result);
                       $('#card-food-image').attr('src', e.target.result);
                    }
                   reader.readAsDataURL(input.files[0]);
                }
                else
                {
                  $('#foodUploadedPhoto').attr('src', '/assets/no_preview.png');
                }
              });
        });
    }
})


window.ListenOnInputChangesTopping = function (ele) {
    ele.addEventListener('keyup', () => {
        // console.log(ele.value);
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

window.ListenOnInputChangesFood = function (ele) {
    ele.addEventListener('keyup', () => {
        console.log(ele.value);
        if(ele.id === `foodName` && validateSpecialCharacters(ele.value)) {
            setErrorOnInputs(ele,true)
        }else if((ele.id === `foodDescription` && validateSpecialCharacters(ele.value))) {
            setErrorOnInputs(ele,true)
        }else if(ele.id !== `foodName` && ele.id !== `foodDescription` && ele.value <= 0 || ele.value.length === 0) {
            setErrorOnInputs(ele,true)
        }else if(ele.id !== `foodName` && ele.id !== `foodDescription` && ele.value === 0) {
            setErrorOnInputs(ele,true)
        }else {
            setErrorOnInputs(ele,false)
        }
    })
}