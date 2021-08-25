let kitchenCards = document.querySelectorAll('.card-kitchen');

$(document).ready(function() {
    let foodId;
    kitchenCards.forEach((ele,index) => {
        $(ele).click(function() {
            console.log('Clicking');
            foodId = ele.querySelector('.card-food-id').innerHTML;

            $(".kitchen-form-container").load("operations/get-kitchen-data-update.php", {
                id: foodId,
            }, function() {
                UpdateListenerKitchen();
            })
        })
    })
    toggleText = true;
    function UpdateListenerKitchen() {
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
        console.log('Working Updated Supplier');

        let selectedIdIngredientsFoods = [];
        let currentIngredientsQuantities = [];
        
        
        let selectedIdsToppings = [];

        let selectingElementFood = [];

        let removeListIngredients = [];

        let confirmedSelected = [];

        let renderSelectedList = [];
        let renderListToppings = [];

        let confirmedIds = [];

        let selectedToppingIds = [];


        // ? Preloading ingredients
        $(".ingredient-list-food-selected").load("operations/get-current-ingredients-exists.php", {
            id: foodId,
        }, function() {
            const ingredientResults = document.querySelectorAll('.resulted-ingredients');
            
            currentIngredients(ingredientResults);
        });


        // ? Preloading Toppings
        $(".toppingss-list-food-selected").load("operations/get-current-toppings-exists.php", {
            id: foodId,
        }, function() {
            const parentToppingResults = document.querySelector('.topping-list');
            const ResultsForToppings = parentToppingResults.querySelectorAll('.resulted-ingredients');
            
            currentToppings(ResultsForToppings);
        });


        

        function currentIngredients(List) {

            List.forEach(ele => {
                confirmedIds.push(ele.querySelector('.selectedIngredientId').innerHTML);
                selectedIdIngredientsFoods.push(ele.querySelector('.selectedIngredientId').innerHTML);
                selectingElementFood.push(ele);
                currentIngredientsQuantities.push(ele.querySelector('.quantityFromIngredient').innerHTML);
            })

            selectingElementFood.forEach(ele => {
                ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
            })

            $("#searchIngredientNames").keyup(function() {
                document.querySelector('.ingredient-list-food').classList.remove('hidden');
                let value = $(this).val();
                if(value !== '') {
                    $(".ingredient-list-food ").load("operations/get-required-ingredients-exists.php", {
                        query: value,
                        alreadyAdded: JSON.stringify(selectedIdIngredientsFoods)
                    }, function() {
                        const newIngredientResults = document.querySelectorAll('.resulted-ingredients');
                        
                        addExtraIngredients(newIngredientResults);
                    });
                }
            })




            // ? Interacting with food Ingredients
            function addExtraIngredients(List) {
                List.forEach((ele, index) => {
                    $(ele).click(function () {
                        ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
                        if(!(ele.querySelector('.isSelectedIngredient').classList.contains('hidden'))) {
                            document.querySelector('.ingredient-list-food').classList.add('hidden');
                            document.querySelector('#IngredientNameFoodDisabled').value = ele.querySelector('.ingredient-name').innerHTML;
                            document.querySelector('#IngredientQuantityFood').value = '';
                            setErrorOnInputs(document.querySelector("#IngredientNameFoodDisabled"),false)
                            document.querySelector('#searchIngredientNames').value = '';


                            document.querySelector('.food-ingredients-inputs').classList.remove('hidden');
                            document.querySelector('.food-ingredients-inputs').classList.add('flex');
                            
                            // ? Adding selected items to render on screen
                
                            selectingElementFood.push(ele);

                            let ifRemoved = removeListIngredients.find(element => element == ele.querySelector('.selectedIngredientId').innerHTML);
                            if(ifRemoved !== undefined) {
                                for(var i =0; i < removeListIngredients.length; i++) {
                                    if(removeListIngredients[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                        removeListIngredients.splice(i, 1);
                                    }
                                }
                            }


                        } else {
                            let ifRemoved = removeListIngredients.find(element => element == document.querySelector('.selectedIngredientId').innerHTML);
                            if(ifRemoved === undefined) {
                                removeListIngredients.push(ele.querySelector('.selectedIngredientId').innerHTML);
                            }

                            for(var i = 0; i < confirmedIds.length; i++) {
                                if(confirmedIds[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                    console.log('Removing ', ele.querySelector(".ingredient-name").innerHTML, " and id ", i);
                                    confirmedIds.splice(i, 1);
                                    currentIngredientsQuantities.splice(i, 1);
                                }
                            }

                            ele.classList.remove('bg-green-400');
                            ele.classList.add('bg-red-400');
                        }
                    })
                })
            }

            addToListClickListener($("#AddtoListIngredientFood"), document.querySelector('#IngredientNameFoodDisabled'), document.querySelector('#IngredientQuantityFood'), $('.selectedTextFood'), currentIngredientsQuantities, selectingElementFood, confirmedSelected, renderSelectedList, confirmedIds, document.querySelector('.ingredient-list-food-selected'), selectedIdIngredientsFoods, removeListIngredients);


            $("#FoodUpdate").click(function() {
                console.log('Current List');
                confirmedIds.forEach(ele => {
                    console.log(ele);
                })
                console.log('\n');


                console.log('Quantity List');
                currentIngredientsQuantities.forEach(ele => {
                    console.log(ele);
                })
                console.log('\n');


                console.log('Removing List');
                removeListIngredients.forEach(ele => {
                    console.log(ele);
                })
                console.log('\n');


                console.log('Selecting List');
                selectingElementFood.forEach(ele => {
                    console.log(ele.querySelector('.ingredient-name').innerHTML);
                })
                console.log('\n');
            })
        }

        function currentToppings(List) {

            List.forEach(ele => {

            })
            

              // ? Search Topping Names
            $("#SearchToppingNames").keyup(function() {

                document.querySelector('.selectedTextToppingLast').classList.remove('hidden');
                document.querySelector('.selectedTextToppingLast').classList.add('flex');

                let value = $(this).val();
                if(value !== '') {
                    // console.log(value);
                    $(".topping-list").load("operations/get-required-toppings-exists.php", {
                        query: value,
                        alreadyAdded: JSON.stringify(selectedIdsToppings)
                    }, function() {
                        const parentToppingResults = document.querySelector('.topping-list');
                        const ResultsForToppings = parentToppingResults.querySelectorAll('.resulted-ingredients');
                        addExtraToppings(ResultsForToppings);
                    });
                }
                
            })

            // ? Interacting with toppings add and remove
            function addExtraToppings(List) {
                List.forEach((ele, index) => {
                    $(ele).click(function () {
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
    
                                // TODO make list
                                // for(var i = 0; i < selectedToppingIds.length; i++) {
                                //     if(selectedIdIngredients[i] == ele.querySelector('.selectedIngredientId').innerHTML) {
                                //         selectedToppingIds.splice(i, 1);
                                //     }
                                // }
    
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
                        })
                    })
                })
            }
        }
        

        $(function(){
       
            $('#SupplierUploadProfile').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                 {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $(".SupplierImageContainer").removeClass("border-blue-600")
                        $(".SupplierImageContainer").removeClass("border-red-500")
                        $(".SupplierImageContainer").addClass("border-green-500")
                       $('#supplierUploadedProfile').attr('src', e.target.result);
                    }
                   reader.readAsDataURL(input.files[0]);
                }
                else
                {
                  $('#SupplierUploadProfile').attr('src', '/assets/no_preview.png');
                }
              });
        });
    }
})