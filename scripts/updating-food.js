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

        let selectingElementFood = [];

        let removeListIngredients = [];

        let confirmedSelected = [];

        let renderSelectedList = [];

        let confirmedIds = [];


        $(".ingredient-list-food-selected").load("operations/get-current-ingredients-exists.php", {
            id: foodId,
        }, function() {
            const ingredientResults = document.querySelectorAll('.resulted-ingredients');
            
            currentIngredients(ingredientResults);
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

            function addToListClickListener (ele, disabled, quantityInput, hiddenSelectedList, quantityList, currentlySelcted, confirmedSelected, renderSelectedList, confirmIds, renderElContainer, idFilter, removedList) {
            
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