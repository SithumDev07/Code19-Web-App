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


        $(".ingredient-list-food-selected ").load("operations/get-current-ingredients-exists.php", {
            id: foodId,
        }, function() {
            const ingredientResults = document.querySelectorAll('.resulted-ingredients');
            
            currentIngredients(ingredientResults);
        });

        // ListenOnInputChanges(document.querySelector('#supplierName'), 'supplier')
        // ListenOnInputChanges(document.querySelector('#supplierEmail'), 'supplier')
        // ListenOnInputChanges(document.querySelector('#supplierAddress'), 'supplier')
        // ListenOnInputChanges(document.querySelector('#supplierPersonalNumber'), 'supplier')
        // ListenOnInputChanges(document.querySelector('#supplierLandLine'), 'supplier')    // ? searchIngredientNames
        

        function currentIngredients(List) {

            List.forEach(ele => {
                selectedIdIngredientsFoods.push(ele.querySelector('.IngredientId').innerHTML);
                currentIngredientsQuantities.push(ele.querySelector('.quantityFromIngredient').innerHTML);
            })

            $("#searchIngredientNames").keyup(function() {
                let value = $(this).val();
                if(value !== '') {
                    $(".ingredient-list-food ").load("operations/get-required-ingredients-exists.php", {
                        query: value,
                        alreadyAdded: JSON.stringify(selectedIdIngredientsFoods)
                    }, function() {
                        const newIngredientResults = document.querySelectorAll('.resulted-ingredients');
                        
                        addExtraIngredients(newIngredientResults);
                        // selectedIdIngredients = selectedIdIngredients.concat(testArray);
                    });
                }
            })


            $("#FoodUpdate").click(function() {
                console.log('Current List');
                selectedIdIngredientsFoods.forEach(ele => {
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
                            
                            // ? Adding selected items to render on screen
                
                            selectingElementFood.push(ele);

                            let ifRemoved = removeListIngredients.find(element => element == document.querySelector('.IngredientId').innerHTML);
                            if(ifRemoved !== undefined) {
                                for(var i =0; i < removeListIngredients.length; i++) {
                                    if(removeListIngredients[i] == ele.querySelector('.IngredientId').innerHTML) {
                                        removeListIngredients.splice(i, 1);
                                    }
                                }
                            }


                        } else {
                            let ifRemoved = removeListIngredients.find(element => element == document.querySelector('.IngredientId').innerHTML);
                            if(ifRemoved === undefined) {
                                removeListIngredients.push(ele.querySelector('.IngredientId').innerHTML);
                            }

                            // TODO make db filtering ingredients id array

                            ele.classList.remove('bg-green-400');
                            ele.classList.add('bg-red-400');
                        }
                    })
                })
            }
            
            
            
            
            window.selctedIngredients = function (ingredientResults) {
                ingredientResults.forEach((ele, index) => {
                    $(ele).click(function() {
                        // document.querySelector('.selectedText').classList.remove('hidden');
                        
                        ele.querySelector('.isSelectedIngredient').classList.toggle('hidden');
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
        }
        
        // $("#UpdateSupplier").click(function(){
        //     console.log('Update Clicked');
        //     const form_data = new FormData();
        //     const image = $("#SupplierUploadProfile")[0].files;
        //     console.log(image[0]);

        //     const name = $("#supplierName").val();
        //     const email = $("#supplierEmail").val();
        //     const address = $("#supplierAddress").val();

        //     const personalNumber = $("#supplierPersonalNumber").val();
        //     const landLine = $("#supplierLandLine").val();
        //     const supplierId = $("#SupplierId").val();
        //     const SupplierPreviousProfile = $("#SupplierPreviousProfile").val();

        //     toggleText = true;
        //     const SupplierImageContainer = document.querySelector('.SupplierImageContainer')
        //     if(!(validateCrewForms(name, email, address, personalNumber, undefined, undefined, landLine, false, document.querySelector('#SupplierUploadProfile'), SupplierImageContainer, 'supplier'))) {
        //         console.log('Not Validated');
        //         $(".supplier-error-message").removeClass("hidden");
        //     }else {
        //         console.log('Validated');
        //         $(".supplier-error-message").addClass("hidden");

        //         form_data.append('profileUpload', image[0]);
        //         form_data.append('name', name);
        //         form_data.append('email', email);
        //         form_data.append('address', address);
        //         form_data.append('mobile', personalNumber);
        //         form_data.append('landline', landLine);
        //         form_data.append('id', supplierId);
        //         form_data.append('prev_file', SupplierPreviousProfile);

        //         $.ajax({
        //             url: 'operations/update-supplier.php',
        //             type: 'POST',
        //             data: form_data,
        //             contentType: false,
        //             processData: false,
        //             success: function(response) {
        //                 alert(response);
        //                 document.querySelector('.transformin-icon').classList.toggle('translate-icon');
        //                 if(toggleText) {
        //                     document.querySelector('.change-text-supplier').innerHTML = "Cancel";
        //                 } else {
        //                     document.querySelector('.change-text-supplier').innerHTML = "Add Supplier";
        //                 }
        //                 toggleText = !toggleText;
        //                 document.querySelector('.supplier-form-container').classList.toggle('hidden');
        //                 document.querySelector('.supplier-form-container').classList.toggle('flex');
        //                 location.reload();
        //             }
        //         });
        //     }
        // })

        // $("#DeleteSupplier").click(function() {
        //     console.log('Deleting Supplier');

        //     toggleText = true;
        
        //     const form_data = new FormData();
        //     const SupplierId = $("#SupplierId").val();
        //     const PreviousProfile = $("#SupplierPreviousProfile").val();
        //     form_data.append('id', SupplierId);
        //     form_data.append('prev_file', PreviousProfile);
        //     $.ajax({
        //         url: 'operations/delete-supplier.php',
        //         type: 'POST',
        //         data: form_data,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             alert(response);
        //             // console.log(response);
        //             location.reload();
        //         }
        //     });
        // })

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