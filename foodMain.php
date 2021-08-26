<?php

session_start();

if (isset($_GET['clear'])) {
    session_unset();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Special</title>
    <link rel="stylesheet" href="./public/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            background-image: url('./assets/backgrounds/bg\ \(Large\).jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-width: 100vh;
        }

        .explore {
            border-bottom-right-radius: 0;
        }

        .glass {
            /* background-color: white; */
            background-image: linear-gradient(to right bottom, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.3));
            z-index: 2;
            backdrop-filter: blur(2rem);
        }

        .glass-dark {
            /* background-color: white; */
            background-image: linear-gradient(to right bottom, rgba(255, 255, 255, 0.0), rgba(255, 255, 255, 0.1));
            z-index: 2;
            backdrop-filter: blur(4rem);
        }

        body::-webkit-scrollbar {
            width: 0.6em;
            border-radius: 50%;
        }

        body::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        body::-webkit-scrollbar-thumb {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 1.2em;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <div class="w-full h-screen fixed glass-dark py-6 px-12 transform scale-0 duration-200 signup-form">
        <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Signup</h1>

        <div class="flex justify-start xl:justify-end w-full">
            <div class="w-1/2 xl:w-1/2 mt-10 xl:-mt-28">
                <div class="flex items-center">
                    <p class="hidden xl:block font-semibold text-gray-300 flex-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae sunt asperiores distinctio vitae alias! Provident, necessitatibus! Eum quas quaerat ipsa.</p>
                    <button class="bg-black p-5 rounded-full text-gray-100 ml-4 transform transition active:scale-90 duration-100" id="signup-close-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <img src="./assets/featured/featured-burger.png" class="object-cover w-full h-full" alt="Signup Featured">
            </div>
        </div>

        <div class="signup fixed left-1/2 xl:left-20 top-1/2 xl:top-2/3 2xl:top-1/2 transform -translate-y-1/2 w-4/12">
            <div class="w-full h-full relative">

                <div class="w-full h-96 rounded">
                    <input type="text" placeholder="Username" class="text-gray-200 rounded-md w-full px-3 py-3 mt-16 bg-transparent border border-gray-200 placeholder-gray-300" id="UsernameCustomer" name="username">
                    <div class=" flex items-center w-full flex-wrap">
                        <input type="text" class="text-gray-200 flex-1 rounded-md xl:rounded-r-none px-3 py-3 mt-4 bg-transparent border border-gray-200 placeholder-gray-300" placeholder="First Name" name="firstname" id="FirstNameCustomer">
                        <input type="text" class="text-gray-200 flex-1 xl:ml-2 rounded-md xl:rounded-l-none px-3 py-3 mt-4 bg-transparent border border-gray-200 placeholder-gray-300" placeholder="Last Name" name="lastname" id="LastNameCustomer">
                    </div>
                    <input type="password" placeholder="Password" class="text-gray-200 rounded-md w-full px-3 py-3 mt-4 bg-transparent border border-gray-200 placeholder-gray-300" name="password" id="PasswordCustomer">
                    <button type="submit" class="relative w-full rounded-md mt-4 flex items-center justify-center bg-blue-600 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-blue-700 transition duration-300" id="SignupCustomer">
                        Signup
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute top-1/2 right-5 transform -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="err-message hidden text-sm xl:text-base absolute -top-10 xl:bottom-3 xl:top-auto text-gray-200 bg-red-400 px-3 py-3 rounded-md">
                    Oops! Seems to be you have entered in incorrect format.
                </div>
            </div>
        </div>
    </div>
    <main class="glass px-10 py-1">
        <nav class="flex justify-between container mx-auto items-center">
            <div class="logo w-24 h-20">
                <a href=""><img src="./assets/logo/main-page-logo.png" class="w-full h-full object-cover" alt="Logo"></a>
            </div>

            <ul class="flex flex-1 justify-center">
                <li><a href="#" class="mr-10 font-bold">Today</a></li>
                <li><a href="#" class="mr-10">How to order?</a></li>
                <li><a href="#" class="mr-10">FAQ</a></li>
                <li><a href="#" class="mr-10">Contact</a></li>
            </ul>

            <div class="flex items-center">
                <?php

                if (isset($_SESSION['sessionUser'])) {
                ?>
                    <a href="" class="mr-4 text-gray-100 font-semibold"><?php echo $_SESSION['sessionUser']; ?></a>
                    <a href="./checkout.php" class="text-white mr-4 relative">
                        <div class="py-1 px-2 rounded-full bg-red-500 absolute -top-2 -right-2 text-xs">3</div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </a>
                    <a href="" class="w-14 h-14 rounded-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" class="w-full h-full object-cover" alt="">
                    </a>

                <?php
                } else {
                ?>

                    <button class="signup w-28 flex items-center justify-center h-12 px-3 py-1 border border-gray-600 rounded-full cursor-pointer mr-4" id="signUpPop">
                        signup
                    </button>
                <?php
                }
                ?>


            </div>
        </nav>




        <!-- Header -->
        <header class="grid grid-cols-2 xl:container xl:mx-auto">
            <div class="left flex justify-center flex-col">
                <h1 class="text-6xl mb-2 font-extrabold text-gray-800 selection:bg-red-500">Get fresh food in a Easy Way</h1>
                <a href="" class="explore flex text-gray-100 bg-black w-36 py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold">Explore <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg></a>

                <div class="flex mt-8">
                    <div class="small-cards w-20 h-24 rounded-md bg-white mr-2">
                        <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                    </div>
                    <div class="small-cards w-20 h-24 rounded-md bg-white mr-2">
                        <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                    </div>
                    <div class="small-cards w-20 h-24 rounded-md bg-white">
                        <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                    </div>
                </div>
            </div>

            <div class="right relative">
                <div class="discount uppercase w-48 py-3 bg-gray-100 bg-opacity-60 absolute top-1/2 transform -translate-y-1/2 left-1/2 -translate-x-1/2 flex items-center justify-center font-bold">
                    upto <p class="text-red-600 mx-1">40%</p> discount
                </div>
                <img src="./assets/featured/featured-burger.png" alt="Featured-Food">
            </div>
        </header>

        <section class="welcome-banner xl:container xl:mx-auto">
            <div class="main-section-banner h-44 rounded-lg flex flex-col px-10 py-5" style="background-image: url('https://i.ibb.co/JnmTD12/banner.jpg'); background-position: center; background-size: cover;">
                <h2 class="text-gray-100 text-xl">Hello Sara!</h2>
                <h4 class="text-base text-gray-200 flex my-2">Get free delivery for every <p class="text-gray-900 mx-2">Rs500</p> purchase.</h4>
                <div class="button bg-white w-36 h-10 rounded-full flex items-center justify-center cursor-pointer">
                    <h4 class="text-yellow-500">Learn More</h4>
                </div>
            </div>
        </section>

        <!-- Menu Category -->
        <div class="menu-category mt-10 xl:container xl:mx-auto">
            <h1 class="text-3xl font-bold text-gray-700">Menu Category</h1>
            <!-- Category Cards -->
            <div class="cat-cards flex mt-6">
                <div class="cursor-pointer card mr-5 flex flex-col items-center py-2 w-36 h-44 bg-gray-50 rounded-xl shadow-lg px-2">
                    <div class="w-14 h-14 my-2">
                        <img src="./assets/icons/Untitled-1.png" class="w-full h-full object-contain" alt="food-icon">
                    </div>
                    <h3 class="text-gray-700 text-center text-base font-bold">Shipwreck Burger</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 h-8 w-8 rounded-full p-2 bg-yellow-500 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="cursor-pointer card mr-5 flex flex-col items-center py-2 w-36 h-44 bg-gray-50 rounded-xl shadow-lg px-2">
                    <div class="w-14 h-14 my-2">
                        <img src="./assets/icons/Untitled-1.png" class="w-full h-full object-contain" alt="food-icon">
                    </div>
                    <h3 class="text-gray-700 text-center text-base font-bold">Shipwreck Burger</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 h-8 w-8 rounded-full p-2 bg-yellow-500 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="cursor-pointer card mr-5 flex flex-col items-center py-2 w-36 h-44 bg-gray-50 rounded-xl shadow-lg px-2">
                    <div class="w-14 h-14 my-2">
                        <img src="./assets/icons/Untitled-1.png" class="w-full h-full object-contain" alt="food-icon">
                    </div>
                    <h3 class="text-gray-700 text-center text-base font-bold">Shipwreck Burger</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 h-8 w-8 rounded-full p-2 bg-yellow-500 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="cursor-pointer card mr-5 flex flex-col items-center py-2 w-36 h-44 bg-gray-50 rounded-xl shadow-lg px-2">
                    <div class="w-14 h-14 my-2">
                        <img src="./assets/icons/Untitled-1.png" class="w-full h-full object-contain" alt="food-icon">
                    </div>
                    <h3 class="text-gray-700 text-center text-base font-bold">Shipwreck Burger</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 h-8 w-8 rounded-full p-2 bg-yellow-500 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="cursor-pointer card mr-5 flex flex-col items-center py-2 w-36 h-44 bg-gray-50 rounded-xl shadow-lg px-2">
                    <div class="w-14 h-14 my-2">
                        <img src="./assets/icons/Untitled-1.png" class="w-full h-full object-contain" alt="food-icon">
                    </div>
                    <h3 class="text-gray-700 text-center text-base font-bold">Shipwreck Burger</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 h-8 w-8 rounded-full p-2 bg-yellow-500 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>




            <!-- Foods -->
            <div class="foods my-12 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-3 2xl:gap-1 xl:container xl:mx-auto">

                <!-- Foods Cards -->


                <div class="card-food mb-5 w-64 h-72 rounded-xl bg-gray-50 shadow-lg flex flex-col items-center relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <div class="w-40 h-40">
                        <img src="./assets/featured/featured-burger.png" alt="Food Today's Special" class="w-full h-full object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3>
                    <div class="stars text-yellow-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-500 mt-1">Rs.780</h3>

                    <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                </div>


                <?php

                // $foodArray = array("foodname" => "Cheese Burger Haloween Special", "rating" => 3.5, "price" => "Rs.780.00");
                $foodArray = array("Cheese Burger", "Chicken Submarine", "Chicken Burger XL", "Chicken Nougets");

                // foreach ($foodArray as $key => $value) {
                //     echo $key . "\n";
                // }
                foreach ($foodArray as $food) {

                ?>
                    <a href="./customizeFoodMenu.php" class="card-food mb-5 w-64 h-72 rounded-xl bg-gray-50 shadow-lg flex flex-col items-center relative cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <div class="w-40 h-40">
                            <img src="./assets/featured/featured-burger.png" alt="Food Today's Special" class="w-full h-full object-contain">
                        </div>
                        <!-- <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3> -->
                        <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1"><?php echo $food ?></h3>
                        <div class="stars text-yellow-500 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-500 mt-1">Rs.780</h3>

                        <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                    </a>

                <?php
                }



                ?>
                <!-- <div class="card-food mb-5 w-64 h-72 rounded-xl bg-gray-50 shadow-lg flex flex-col items-center relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                      <div class="w-40 h-40">
                        <img src="./assets/featured/featured-burger.png" alt="Food Today's Special" class="w-full h-full object-contain">
                      </div>
                      <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3>
                      <div class="stars text-yellow-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                      </div>
                      <h3 class="text-xl font-bold text-gray-500 mt-1">Rs.780</h3>

                      <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                          </svg>
                      </div>
                </div>
                <div class="card-food mb-5 w-64 h-72 rounded-xl bg-gray-50 shadow-lg flex flex-col items-center relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                      <div class="w-40 h-40">
                        <img src="./assets/featured/featured-burger.png" alt="Food Today's Special" class="w-full h-full object-contain">
                      </div>
                      <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3>
                      <div class="stars text-yellow-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                      </div>
                      <h3 class="text-xl font-bold text-gray-500 mt-1">Rs.780</h3>

                      <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                          </svg>
                      </div>
                </div>
                <div class="card-food mb-5 w-64 h-72 rounded-xl bg-gray-50 shadow-lg flex flex-col items-center relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                      <div class="w-40 h-40">
                        <img src="./assets/featured/featured-burger.png" alt="Food Today's Special" class="w-full h-full object-contain">
                      </div>
                      <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3>
                      <div class="stars text-yellow-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                      </div>
                      <h3 class="text-xl font-bold text-gray-500 mt-1">Rs.780</h3>

                      <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                          </svg>
                      </div>
                </div>
                <div class="card-food mb-5 w-64 h-72 rounded-xl bg-gray-50 shadow-lg flex flex-col items-center relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                      <div class="w-40 h-40">
                        <img src="./assets/featured/featured-burger.png" alt="Food Today's Special" class="w-full h-full object-contain">
                      </div>
                      <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3>
                      <div class="stars text-yellow-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                          </svg>
                      </div>
                      <h3 class="text-xl font-bold text-gray-500 mt-1">Rs.780</h3>

                      <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                          </svg>
                      </div>
                </div> -->
            </div>
        </div>
    </main>
    <script src="./scripts/customer-signup.js"></script>
    <script src="./scripts/common.js"></script>
</body>

</html>