<?php
include '../config.php';

// $sql = "SELECT * FROM supplier inner JOIN (select * from supplier_contact group by id order by contact_no desc) AS supplier_contact ON supplier.id = supplier_contact.id;";
$sql = "select * from ingredient;";
$results = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($results);
?>

<div class="w-full h-full add-kitchen-form hidden overflow-y-auto flex-col">

    <div class="flex mt-10 items-start">

        <div class="card-kitchen mb-4 w-72 overflow-hidden relative flex flex-col cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">

            <div class="flex items-center flex-1 mb-2">
                <div class="w-16 h-16 rounded-full overflow-hidden flex-1">
                    <img class="object-contain w-full h-full rounded-full" src="./assets/featured/featured-burger.png" id="card-food-image" alt="foodImage">
                </div>
                <div>
                    <h1 class="text-gray-600 font-semibold text-sm">Consist of 12 ingredients</h1>
                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                    <p class="text-xs text-gray-500">Popularity</p>
                    <div class="flex items-center text-yellow-400 mt-1">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>

                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-400 my-1 card-description">Description</p>
            <h1 class="text-gray-600 font-semibold flex-1 card-foodName">Food Name</h1>

            <div class="flex items-center mt-2 justify-between">
                <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Low
                </button>

                <div class="text-gray-500 text-xs flex flex-col items-end">
                    <h1 class="text-gray-600 font-semibold flex-1 card-foodName text-xl card-basicPrice">Rs.180.00</h1>
                    Disappearing Status
                </div>
            </div>
            <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
        </div>

        <div class="flex flex-1 px-8">

            <div class="flex flex-col flex-1 px-6">
                <input type="text" placeholder="Food Name" class="mb-5 rounded-md bg-transparent" id="foodName" name="name">

                <textarea name="description" id="foodDescription" class="appearance-none mb-5 py-2 px-3 text-gray-700 leading-tight focus:outline-none bg-transparent focus:shadow-outline rounded-md transform transition-colors duration-300" placeholder="Description"></textarea>

                <input type="number" placeholder="Basic Price" class="mb-5 rounded-md transform transition-colors duration-300 bg-transparent" id="unitPriceFood" name="unitprice">

                <div class="flex items-center">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="preparationtime">
                            Preparation Time (Mins)
                        </label>
                        <input type="number" placeholder="Time" class="mb-5 bg-transparent rounded-md transform transition-colors duration-300" id="foodPrepTime" name="preparationtime">
                    </div>
                </div>
            </div>

            <div class="w-80 h-64 rounded-lg overflow-hidden relative cursor-pointer profile-picture p-1 border-2 foodImageContainer shadow-2xl">
                <i class="fas fa-camera text-white absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-3xl z-10"></i>
                <img id="foodUploadedPhoto" class="rounded-lg opacity-80 w-full h-full object-cover" src="./photo_uploads/users/burger.jpg" alt="Food Photo">
                <input type="file" name="foodUpload" id="foodPhotoUpload">
            </div>

        </div>
    </div>

    <div class="flex flex-col my-5 px-12">
        <h2 class="text-3xl text-gray-400 font-semibold mb-4">Choose required ingredients</h2>
        <input type="text" placeholder="Search for Ingredient Name" class="mb-3 rounded-md bg-transparent" id="searchIngredientNames" name="name">
        <div class="ingredient-list-food flex flex-wrap">
            <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
        </div>
    </div>

    <h2 class="text-3xl text-gray-400 font-semibold my-4 px-12 hidden topic-ingredient-food">How much need from each ingredient?</h2>

    <div class="items-end hidden food-ingredients-inputs px-12">
        <input type="text" placeholder="Selected Ingredient Name" class="flex-1 rounded-md bg-transparent mr-5" id="IngredientNameFoodDisabled" disabled name="name">
        <div class=" flex items-center">
            <div class="flex flex-col">
                <label class="block text-gray-700 text-sm font-bold mb-2 mx-4" for="Quantity">
                    Quantity to make
                </label>
                <input type="number" placeholder="Quantity" class="mx-4 bg-transparent rounded-md transform transition-colors duration-300" id="IngredientQuantityFood" name="quantity">
            </div>
        </div>
        <div class="flex flex-col ml-2">
            <label class="block text-gray-700 text-sm font-bold mr-2 mb-2" for="metricType">
                Type
            </label>
            <select class="px-3 py-2 w-auto rounded bg-transparent" id="IngredientMetricTypeFood" name="metricType">

                <option value="g">g</option>
                <option value="ml">ml</option>
                <option value="pieces">pieces</option>
            </select>
        </div>
        <button class="flex items-center text-green-500 mx-5 mb-0 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="AddtoListIngredientFood" type="submit" name="addtolist">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Add to list
        </button>
    </div>

    <div class="flex-col my-5 px-12 hidden selectedTextFood">
        <h2 class="text-2xl text-gray-400 font-semibold mb-4">Selected</h2>
        <div class="ingredient-list-food-selected flex flex-wrap">
            <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
        </div>
    </div>


    <!-- // ? Toppings Area -->

    <div class="flex flex-col mt-10 mb-5 px-12">
        <h2 class="text-3xl text-gray-400 font-semibold mb-4">Select Toppings</h2>
        <div class="flex items-center">
            <input type="text" placeholder="Topping Name" class=" flex-1 rounded-md bg-transparent" id="SearchToppingNames" name="name">
            <h3 class="text-xl text-gray-400 font-semibold mx-3">Or</h3>
            <button class="flex items-center text-green-500 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="ToppingAdd" type="submit" name="food-submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-change-creating-topping">Create</h3>
            </button>
        </div>

        <div class="toppings-list-food flex flex-wrap">
            <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
        </div>
    </div>

    <div class="px-12 flex-col creating-a-topping hidden">
        <h2 class="text-3xl text-gray-400 font-semibold mt-5">Creating a Topping</h2>
        <div class="flex items-end mt-3 mb-3">
            <input type="text" placeholder="Topping Name" class=" flex-1 rounded-md bg-transparent mr-5" id="CreateToppingName" name="name">
            <div class="flex flex-col">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="ingredientName">
                    Price in rupees
                </label>
                <input type="number" placeholder="Unit Price" class="bg-transparent rounded-md transform transition-colors duration-300" id="ToppingPrice" name="cost">
            </div>
        </div>
        <input type="text" placeholder="Search Ingredient Name" class="flex-1 rounded-md bg-transparent" id="searchIngredientNamesOnTopping" name="name">

        <div class="flex-col my-5 px-12 selectedTextTopping">
            <div class="topping-list-ingredient flex flex-wrap">
                <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
            </div>
        </div>

        <div class="flex items-end mt-5">
            <input type="text" placeholder="Selected Ingredient Name" class="flex-1 rounded-md bg-transparent mr-5" id="SelectedIngredientNameDisabled" disabled name="name">
            <div class=" flex items-center">
                <div class="flex flex-col">
                    <label class="block text-gray-700 text-sm font-bold mb-2 mx-4" for="shift">
                        Quantity to make
                    </label>
                    <input type="number" placeholder="Quantity" class="mx-4 bg-transparent rounded-md transform transition-colors duration-300" id="IngredientQuantityTopping" name="quantity">
                </div>
            </div>
            <div class="flex flex-col ml-2">
                <label class="block text-gray-700 text-sm font-bold mr-2 mb-2" for="metricType">
                    Type
                </label>
                <select class="px-3 py-2 w-auto rounded bg-transparent" id="IngredientMetricTypeTopping" name="metricType">

                    <option value="g">g</option>
                    <option value="ml">ml</option>
                    <option value="pieces">pieces</option>
                </select>
            </div>
            <button class="flex items-center text-green-500 mx-5 mb-0 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="AddtoListIngredient" type="submit" name="addtolist">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Add to list
            </button>
        </div>

        <div class="flex-col my-5 px-12 hidden selectedList">
            <h2 class="text-3xl text-gray-400 font-semibold mb-4">Added List</h2>
            <div class="ingredient-list-topping-selected flex flex-wrap">
                <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
            </div>
        </div>



        <div class="flex justify-end items-center mt-5">
            <button class="flex items-center text-green-500 mx-5 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="InsertTopping" type="submit" name="topping-submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Create
            </button>
        </div>
    </div>

    <!-- // ? Topping List -->
    <div class="flex-col my-5 px-12 selectedTextToppingLast">
        <div class="topping-list flex flex-wrap">
            <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
        </div>
    </div>

    <!-- // ? Selected Toppings List -->
    <div class="flex-col my-5 px-12 hidden selectedTextToppinss">
        <h2 class="text-2xl text-gray-400 font-semibold mb-4">Selected Toppings</h2>
        <div class="toppingss-list-food-selected flex flex-wrap">
            <!-- <button class="flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                All Purpose Flour
            </button> -->
        </div>
    </div>

    <div class="flex-1 mb-56 mt-3 px-12">
        <div class="flex justify-end items-center">
            <p class="text-red-500 font-semibold text-sm hidden food-error-message">Oops. It seems to be some inputs are not filled.</p>
            <button class="flex items-center text-green-500 mx-5 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="FoodInsert" type="submit" name="food-submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Publish
            </button>
        </div>
    </div>
</div>