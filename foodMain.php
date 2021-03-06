<?php

require './config.php';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .topping-error-active {
            /* animation: popup 1s linear; */

            bottom: 2rem;
        }

        .bounce-err {
            animation: bounce 0.5s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        .toppings::-webkit-scrollbar,
        .customize-menu::-webkit-scrollbar,
        .profile-data::-webkit-scrollbar {
            width: 0.6em;
            border-radius: 50%;
        }

        .toppings::-webkit-scrollbar-track,
        .customize-menu::-webkit-scrollbar-track,
        .profile-data::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .toppings::-webkit-scrollbar-thumb,
        .customize-menu::-webkit-scrollbar-thumb,
        .profile-data::-webkit-scrollbar-thumb {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 1.2em;
        }

        .toppings,
        .customize-menu {
            -webkit-overflow-scrolling: touch;
        }

        .cart-cards::-webkit-scrollbar,
        .cart::-webkit-scrollbar,
        .checkout-menu::-webkit-scrollbar,
        .customer-profile::-webkit-scrollbar,
        .payment::-webkit-scrollbar {
            width: 0.6em;
            border-radius: 50%;
        }

        .cart-cards::-webkit-scrollbar-track,
        .cart::-webkit-scrollbar-track,
        .checkout-menu::-webkit-scrollbar-track,
        .customer-profile::-webkit-scrollbar-track,
        .payment::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .cart-cards::-webkit-scrollbar-thumb,
        .cart::-webkit-scrollbar-thumb,
        .checkout-menu::-webkit-scrollbar-thumb,
        .customer-profile::-webkit-scrollbar-thumb,
        .payment::-webkit-scrollbar-thumb {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 1.2em;
        }

        .add-card-active {
            height: auto;
        }

        .slider::before {
            position: absolute;
            content: "";
            width: 2rem;
            height: 2rem;
            left: 0.3rem;
            top: 50%;
            transform: translateY(-50%);
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
            --tw-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            box-shadow: var(--tw-shadow, 0 0 #0000), var(--tw-shadow, 0 0 #0000), var(--tw-shadow);
        }

        .toggle-switch:checked+.slider {
            background-color: rgba(52, 61, 255, 1);
        }

        .toggle-switch:checked+.slider::before {
            left: unset;
            right: 0.3rem;
            background-color: white;
        }

        .translate-icon {
            transform: rotate(45deg);
        }

        .fa-camera {
            top: 150%;
            transition: top 0.4s ease-in-out;
        }

        .profile-picture-customer:hover>i {
            top: 50%;
        }

        #UploadProfileCustomer {
            position: absolute;
            top: 0;
            z-index: 10;
            width: 48rem;
            height: 48rem;
            opacity: 0;
            left: 0;
            cursor: pointer;
        }

        #UploadProfileCustomer::-webkit-file-upload-button {
            visibility: hidden;
        }
    </style>
</head>

<body>
    <!-- // ? Register -->
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

                    <div class="flex items-center text-gray-700 text-lg mt-5">
                        <p>Already have an account?</p>
                        <a class="text-blue-600 font-bold ml-3" href="./foodMain.php?login">Login</a>
                    </div>
                </div>

                <div class="err-message hidden text-sm xl:text-base absolute -top-10 xl:bottom-3 xl:top-auto text-gray-200 bg-red-400 px-3 py-3 rounded-md">
                    Oops! Seems to be you have entered in incorrect format.
                </div>
            </div>
        </div>
    </div>

    <!-- // ? Login -->
    <div class="w-full h-screen fixed glass-dark py-6 px-12 transform scale-0 duration-200 login-form">
        <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Login</h1>

        <div class="flex justify-start xl:justify-end w-full">
            <div class="w-1/2 xl:w-1/2 mt-10 xl:-mt-28">
                <div class="flex items-center">
                    <p class="hidden xl:block font-semibold text-gray-300 flex-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae sunt asperiores distinctio vitae alias! Provident, necessitatibus! Eum quas quaerat ipsa.</p>
                    <button class="bg-black p-5 rounded-full text-gray-100 ml-4 transform transition active:scale-90 duration-100" id="loginCloseButton">
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
                    <input type="text" placeholder="Username" class="text-gray-200 rounded-md w-full px-3 py-3 mt-16 bg-transparent border border-gray-200 placeholder-gray-300" id="UsernameCustomerLogin" name="username">
                    <input type="password" placeholder="Password" class="text-gray-200 rounded-md w-full px-3 py-3 mt-4 bg-transparent border border-gray-200 placeholder-gray-300" name="password" id="PasswordCustomerLogin">
                    <button type="submit" class="relative w-full rounded-md mt-4 flex items-center justify-center bg-blue-600 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-blue-700 transition duration-300" id="LoginCustomer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Login
                    </button>
                </div>

                <div class="err-message-login hidden text-sm xl:text-base absolute -top-10 xl:bottom-3 xl:top-auto text-gray-200 bg-red-400 px-3 py-3 rounded-md">
                    Oops! Seems to be you have entered in incorrect format.
                </div>
            </div>
        </div>
    </div>

    <!--  // ? Food Customize Menu -->
    <section class="glass-dark px-3 md:px-10 py-1 h-screen fixed top-0 right-0 left-0 bottom-0 z-30 transform scale-0 duration-200 customize-menu overflow-y-auto xl:overflow-hidden">


    </section>

    <!-- // ?Cart -->

    <section class="glass-dark px-3 md:px-10 py-1 h-full fixed top-0 right-0 left-0 bottom-0 z-30 transform scale-0 duration-200 checkout-menu overflow-y-auto xl:overflow-hidden">


        <button class="fixed h-14 w-14 rounded-full bg-black top-1 md:top-6 left-1 md:left-6 flex justify-center items-center text-white cursor-pointer z-50" id="CartClose">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <div class="w-full h-full hidden items-center justify-center empty-cart">
            <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Cart is empty.</h1>
        </div>

        <div class="flex items-center absolute top-10 right-10 z-40 takeawayContainer">
            <h3 class="text-2xl font-semibold text-gray-100 mr-3">Take Away</h3>
            <label class="switch relative inline-block w-16 h-10 ml-4">
                <input type="checkbox" class="toggle-switch hidden" name="paid" id="isTakeaway">
                <span class="slider cursor-pointer top-0 left-0 right-0 bottom-0 absolute bg-gray-50 transform transition duration-300 rounded-full"></span>
            </label>
        </div>


        <!-- Header -->
        <header class="flex flex-col xl:flex-row xl:container xl:mx-auto h-screen cart-header">
            <div class="left flex flex-col xl:flex-1 px-2">
                <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Checkout</h1>

                <div class="cart overflow-y-auto">
                    <div class="payment w-full h-auto border rounded-md p-6 my-4">
                        <div class="flex flex-col overflow-hidden h-48 add-card">
                            <div class="flex">
                                <?php
                                if (isset($_SESSION['sessionId'])) {


                                    $sql = "SELECT * FROM paymentmethod WHERE customer_id = " . $_SESSION['sessionId'] . ";";
                                    $results = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($results);

                                    $nameOnCard;
                                    $cardNumber;
                                    $expireDate;
                                    $CVC;
                                    $cardType;
                                    $update = false;

                                    if ($resultCheck > 0) {
                                        $update = true;
                                        while ($row = mysqli_fetch_assoc($results)) {
                                            $nameOnCard = $row['name_upon_card'];
                                            $cardNumber = $row['card_number'];
                                            $expireDate = $row['expire_date'];
                                            $CVC = $row['cvc'];
                                            $cardType = $row['card_type'];
                                            $cardid = $row['id'];
                                        }

                                ?>
                                        <div class="credit-card w-72 h-44 rounded-2xl flex flex-col p-3 justify-between bg-primary relative overflow-hidden">
                                            <div class="flex justify-between relative">
                                                <div class="w-6 h-6 rounded-full bg-gray-50 opacity-40"></div>
                                                <div class="w-6 h-6 rounded-full bg-gray-50 absolute top-0 left-4 z-10"></div>
                                                <p class="hidden credit-card-id"><?php echo $cardid; ?></p>
                                                <p class="hidden credit-card-cvc"><?php echo $CVC; ?></p>
                                                <h4 class="uppercase font-semibold text-gray-100 text-lg card-type-display italic"><?php if ($cardType != null) {
                                                                                                                                        echo $cardType;
                                                                                                                                    } else { ?>visa<?php } ?></h4>
                                            </div>
                                            <h3 class="font-semibold text-2xl text-gray-200 card-number-display"><?php if ($cardNumber != null) {
                                                                                                                        $formattedNumber = substr($cardNumber, 0, 4) . " XXXX " . substr($cardNumber, 8, 12);
                                                                                                                        echo $formattedNumber;
                                                                                                                    } else { ?>XXXX XXXX XXXX<?php } ?></h3>
                                            <div class="flex justify-between">
                                                <h3 class="uppercase font-semibold text-gray-200 text-sm card-name-display"><?php if ($nameOnCard != null) {
                                                                                                                                if (strlen($nameOnCard) > 16) {
                                                                                                                                    $formattedName = substr($nameOnCard, 0, 16) . "...";
                                                                                                                                } else {
                                                                                                                                    $formattedName = $nameOnCard;
                                                                                                                                }
                                                                                                                                echo $formattedName;
                                                                                                                            } else { ?>Your Name<?php } ?></h3>
                                                <h3 class="uppercase font-semibold text-gray-200 text-sm z-20 expire-date-display"><?php if ($expireDate != null) {
                                                                                                                                        echo $expireDate;
                                                                                                                                    } else { ?>XX/XX<?php } ?></h3>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 absolute -bottom-20 -right-16 text-blue-400 z-10" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                            </svg>
                                        </div>

                                    <?php
                                    } else {
                                    ?>
                                        <h3 class="font-semibold text-lg text-gray-800 credit-card-warning should-show">No Credit or Debit Card added to your account.</h3>
                                        <div class="hidden hidden-credit-card-cart w-72 h-44 rounded-2xl flex-col p-3 justify-between bg-primary relative overflow-hidden">
                                            <div class="flex justify-between relative">
                                                <div class="w-6 h-6 rounded-full bg-gray-50 opacity-40"></div>
                                                <div class="w-6 h-6 rounded-full bg-gray-50 absolute top-0 left-4 z-10"></div>
                                                <h4 class="uppercase font-semibold text-gray-100 text-lg italic card-type-display">visa</h4>
                                            </div>
                                            <h3 class="font-semibold text-2xl text-gray-200 card-number-display">XXXX XXXX XXXX</h3>
                                            <div class="flex justify-between">
                                                <h3 class="uppercase font-semibold text-gray-200 text-sm card-name-display">Your Name</h3>
                                                <h3 class="uppercase font-semibold text-gray-200 text-sm z-20 expire-date-display">XX/XX</h3>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 absolute -bottom-20 -right-16 text-blue-400 z-10" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                            </svg>
                                        </div>
                                <?php
                                    }
                                }
                                ?>

                                <div class="w-44 h-44 rounded-2xl border-dotted border-2 border-gray-200 ml-5 flex items-center justify-center">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 bg-opacity-10 flex items-center justify-center text-gray-100">
                                        <button class="transform transition duration-200 hover:scale-110" id="expandCardInputsCart">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="err-message-card-profile hidden w-4/5 lg:w-1/2 xl:w-full mx-auto text-center text-sm xl:text-base mt-6 mb-1 text-gray-200 bg-red-400 px-3 py-3 rounded-md z-20">
                                Oops! Seems to be you have entered in incorrect format.
                            </div>

                            <div class="flex flex-col my-4">
                                <h1 class='text-gray-200 text-2xl font-semibold mb-3'>Add new card</h1>
                                <input type="text" name="nameOnCard" id="nameOnCardCart" placeholder="Name on card" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-full mb-3">
                                <div class="flex justify-between">
                                    <input type="text" name="cardNumber" maxlength="14" id="cardNumberCart" placeholder="Card number" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-80 mb-3">
                                    <input type="text" name="expireDate" maxlength="5" id="expireDateCart" placeholder="Expiration date YY/MM" class="ml-4 border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 mb-3">
                                </div>
                                <div class="flex justify-between">
                                    <input type="text" name="CVC" maxlength="3" id="CVCCart" placeholder="CVC" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-64 mb-3">
                                    <p class="text-base text-gray-200 font-thin ml-5">By clicking confirm "I agree to the company's <a href="terms.html" class='text-black font-medium'>terms and services.</a></p>
                                </div>
                                <div class="flex justify-between">
                                    <button class="px-5 py-3 text-red-600 rounded-md ml-4" id="cancelCardCart">Remove</button>
                                    <button class="px-5 py-3 bg-black rounded-md ml-4 text-white transition duration-150 hover:shadow-lg" id="ConfirmCardCart">Confirm</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  // TODO Take Care of this later -->
                    <div class="items-center hidden">
                        <input type="text" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4" placeholder="Discount Code">
                        <button class="px-5 py-3 bg-black rounded-md ml-4 text-white transition duration-150 hover:shadow-lg" id="ApplyCoupen">Apply</button>
                    </div>

                    <div class="flex flex-col my-4 text-gray-100 text-xl bg-gray-800 bg-opacity-20 p-3 rounded-xl total-container">
                        <div class="flex justify-between border-b py-3">
                            <h3>Total</h3>
                            <h3 class="pre-total">$490</h3>
                        </div>
                        <div class="flex justify-between my-2">
                            <h3>Delivery Charges</h3>
                            <h3 class="text-green-500 deliveryCharges">+ Rs.100</h3>
                        </div>
                        <div class="flex justify-between border-b py-3">
                            <h3>Extra Toppings</h3>
                            <h3 class="text-green-500 totalExtraToppings">+ Rs.0</h3>
                        </div>
                        <div class="flex justify-between mt-3 text-3xl font-bold">
                            <h2>Total Amount</h2>
                            <h2 class="grandTotal">$560</h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="right relative flex xl:justify-center flex-col flex-1 p-2">
                <div class="cart-cards w-full h-auto border rounded-md p-6 overflow-y-auto mt-20">

                    <!-- // ?End of card -->

                </div>
            </div>

            <!-- // ? Online Pay Button -->
            <button class="rounded-br-none fixed bottom-5 right-10 explore flex text-gray-100 bg-black py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold disabled:opacity-50" disabled id="onlinePay">
                Confirm Payment <h3 class="amount-button-confirm ml-3">$560</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </button>

            <!-- // ? Takeaway Button -->
            <button class="rounded-br-none fixed bottom-5 right-10 explore hidden text-gray-100 bg-black py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold disabled:opacity-50" id="confirmTakeaway">
                Place Order <h3 class="amount-button-takeaway ml-3">$560</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </button>
        </header>
    </section>

    <!-- // ? Customer Profile -->

    <section class="glass-dark px-3 md:px-10 py-1 h-full fixed top-0 right-0 left-0 bottom-0 z-30 transform scale-0 duration-200 customer-profile overflow-y-auto xl:overflow-hidden">

        <button class="fixed h-14 w-14 rounded-full bg-black top-1 md:top-6 right-1 md:right-6 flex justify-center items-center text-white cursor-pointer z-50" id="ProfileClose">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Header -->
        <header class="flex flex-col xl:flex-row xl:container xl:mx-auto h-screen">
            <div class="left flex flex-col px-2 flex-1">

                <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Profile</h1>
                <div class="payment payment-profile w-full h-auto border rounded-md p-6 my-4">


                    <div class="flex flex-col overflow-hidden h-48 add-card-profile">
                        <div class="flex w-1/2 xl:w-full mx-auto">
                            <?php
                            if (isset($_SESSION['sessionId'])) {


                                $sql = "SELECT * FROM paymentmethod WHERE customer_id = " . $_SESSION['sessionId'] . ";";
                                $results = mysqli_query($conn, $sql);
                                $resultCheck = mysqli_num_rows($results);

                                $nameOnCard;
                                $cardNumber;
                                $expireDate;
                                $CVC;
                                $cardType;
                                $update = false;

                                if ($resultCheck > 0) {
                                    $update = true;
                                    while ($row = mysqli_fetch_assoc($results)) {
                                        $nameOnCard = $row['name_upon_card'];
                                        $cardNumber = $row['card_number'];
                                        $expireDate = $row['expire_date'];
                                        $CVC = $row['cvc'];
                                        $cardType = $row['card_type'];
                                        $cardid = $row['id'];
                                    }

                            ?>
                                    <div class="credit-card w-72 h-44 rounded-2xl flex flex-col p-3 justify-between bg-primary relative overflow-hidden">
                                        <div class="flex justify-between relative">
                                            <div class="w-6 h-6 rounded-full bg-gray-50 opacity-40"></div>
                                            <div class="w-6 h-6 rounded-full bg-gray-50 absolute top-0 left-4 z-10"></div>
                                            <p class="hidden credit-card-id"><?php echo $cardid; ?></p>
                                            <h4 class="uppercase font-semibold text-gray-100 text-lg card-type-display italic"><?php if ($cardType != null) {
                                                                                                                                    echo $cardType;
                                                                                                                                } else { ?>visa<?php } ?></h4>
                                        </div>
                                        <h3 class="font-semibold text-2xl text-gray-200 card-number-display"><?php if ($cardNumber != null) {
                                                                                                                    $formattedNumber = substr($cardNumber, 0, 4) . " XXXX " . substr($cardNumber, 8, 12);
                                                                                                                    echo $formattedNumber;
                                                                                                                } else { ?>XXXX XXXX XXXX<?php } ?></h3>
                                        <div class="flex justify-between">
                                            <h3 class="uppercase font-semibold text-gray-200 text-sm card-name-display"><?php if ($nameOnCard != null) {
                                                                                                                            if (strlen($nameOnCard) > 16) {
                                                                                                                                $formattedName = substr($nameOnCard, 0, 16) . "...";
                                                                                                                            } else {
                                                                                                                                $formattedName = $nameOnCard;
                                                                                                                            }
                                                                                                                            echo $formattedName;
                                                                                                                        } else { ?>Your Name<?php } ?></h3>
                                            <h3 class="uppercase font-semibold text-gray-200 text-sm z-20 expire-date-display"><?php if ($expireDate != null) {
                                                                                                                                    echo $expireDate;
                                                                                                                                } else { ?>XX/XX<?php } ?></h3>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 absolute -bottom-20 -right-16 text-blue-400 z-10" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                        </svg>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <h3 class="font-semibold text-lg text-gray-800 credit-card-warning">No Credit or Debit Card added to your account.</h3>
                                    <div class="hidden hidden-credit-card w-72 h-44 rounded-2xl flex-col p-3 justify-between bg-primary relative overflow-hidden">
                                        <div class="flex justify-between relative">
                                            <div class="w-6 h-6 rounded-full bg-gray-50 opacity-40"></div>
                                            <div class="w-6 h-6 rounded-full bg-gray-50 absolute top-0 left-4 z-10"></div>
                                            <h4 class="uppercase font-semibold text-gray-100 text-xl card-type-display">visa</h4>
                                        </div>
                                        <h3 class="font-semibold text-2xl text-gray-200 card-number-display">XXXX XXXX XXXX</h3>
                                        <div class="flex justify-between">
                                            <h3 class="uppercase font-semibold text-gray-200 text-sm card-name-display">Your Name</h3>
                                            <h3 class="uppercase font-semibold text-gray-200 text-sm z-20 expire-date-display">XX/XX</h3>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 absolute -bottom-20 -right-16 text-blue-400 z-10" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                        </svg>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <div class="w-44 h-44 rounded-2xl border-dotted border-2 border-gray-200 ml-5 flex items-center justify-center">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 bg-opacity-10 flex items-center justify-center text-gray-100">
                                    <button class="transform transition duration-200 hover:scale-110" id="addNewCard">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="err-message-card-profile hidden w-4/5 lg:w-1/2 xl:w-full mx-auto text-center text-sm xl:text-base mt-6 mb-1 text-gray-200 bg-red-400 px-3 py-3 rounded-md z-20">
                            Oops! Seems to be you have entered in incorrect format.
                        </div>

                        <div class="flex flex-col my-4 w-1/2 xl:w-full mx-auto">
                            <h1 class='text-gray-200 text-2xl font-semibold mb-3'>Add new card</h1>
                            <input type="text" name="nameOnCard" id="nameOnCardProfile" placeholder="Name on card" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-full mb-3">
                            <div class="flex justify-between">
                                <input type="text" name="cardNumber" maxlength="14" id="cardNumberProfile" placeholder="Card number" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-80 mb-3">
                                <input type="text" name="expireDate" maxlength="5" id="expireDateProfile" placeholder="Expiration date YY/MM" class="ml-4 border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 mb-3">
                            </div>
                            <div class="flex justify-between">
                                <input type="text" name="CVC" maxlength="3" id="CVCProfile" placeholder="CVC" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-64 mb-3">
                                <p class="text-base text-gray-200 font-thin ml-5">By clicking confirm "I agree to the company's <a href="terms.html" class='text-black font-medium'>terms and services.</a></p>
                            </div>
                            <div class="flex <?php if ($update) {
                                                    echo 'justify-between';
                                                } else {
                                                    echo 'justify-end';
                                                } ?>">
                                <?php
                                if ($update) {
                                ?>
                                    <button class="px-5 py-3 text-red-600 rounded-md ml-4" id="removeCard">Remove</button>
                                    <button class="px-5 py-3 bg-black rounded-md ml-4 text-white transition duration-150 hover:shadow-lg" id="UpdateCard">Update</button>
                                <?php
                                } else {
                                ?>

                                    <button class="px-5 py-3 bg-black rounded-md ml-4 text-white transition duration-150 hover:shadow-lg" id="ConfirmCard">Confirm</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right w-1/2 xl:w-full mx-auto py-4 px-10 profile-data xl:overflow-y-scroll 2xl:overflow-hidden flex-1 2xl:flex 2xl:justify-center 2xl:flex-col">

            </div>
        </header>
    </section>

    <!-- // ? Home Menu -->
    <main class="glass px-10 py-1 home-menu">
        <nav class="flex justify-between container mx-auto items-center">
            <div class="logo w-24 h-20">
                <a href=""><img src="./assets/logo/main-page-logo.png" class="w-full h-full object-cover" alt="Logo"></a>
            </div>

            <ul class="flex flex-1 justify-center">
                <li><a href="/code19/foodMain.php" class="mr-10 font-bold">Today</a></li>
                <li><a href="/code19/HowToOrder.php" class="mr-10">How to order?</a></li>
                <li><a href="/code19/black-mafia-special.php" class="mr-10 relative">Black Mafia Special <div class="bg-red-600 px-2 absolute -top-5 -right-4 rounded-3xl text-gray-50" style="font-size: x-small; padding-top: 0.25rem; padding-bottom: 0.25rem;">new</div> </a></li>
                <li><a href="/code19/FAQ.php" class="mr-10">FAQ</a></li>
                <li><a href="/code19/Contact.php" class="mr-10">Contact</a></li>
            </ul>

            <div class="flex items-center">
                <p class="sessionId hidden"><?php if (isset($_SESSION['sessionId'])) {
                                                echo $_SESSION['sessionId'];
                                            } else {
                                                // echo "NotAUser";
                                            } ?></p>
                <?php

                if (isset($_SESSION['sessionUser'])) {
                ?>
                    <a href="" class="mr-4 text-gray-100 font-semibold sessionUsername"><?php echo $_SESSION['sessionUser']; ?></a>
                    <button class="text-white mr-4 relative" id="Cart">
                        <div class="py-1 px-2 rounded-full bg-red-500 absolute -top-2 -right-2 text-xs cart-counter"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </button>
                    <?php
                    if (isset($_SESSION['sessionId'])) {
                        $sql = "SELECT * FROM customer WHERE id = " . $_SESSION['sessionId'] . ";";
                        $results = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($results);

                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($results)) {
                                if ($row['photo'] != null) {
                    ?>
                                    <button class="w-14 h-14 rounded-full overflow-hidden transform transition active:scale-75 duration-150 hover:scale-105" id="CustomerProfile">
                                        <img src="./photo_uploads/customers/<?php echo $row['photo']; ?>" class="w-full h-full object-cover" alt="Customer Profile Picture">
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button class="w-14 h-14 rounded-full overflow-hidden transform transition active:scale-75 duration-150 hover:scale-105" id="CustomerProfile">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                        <?php
                                }
                            }
                        }
                    } else {
                        ?>
                        <button class="w-14 h-14 rounded-full overflow-hidden transform transition active:scale-75 duration-150 hover:scale-105" id="CustomerProfile">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    <?php
                    }

                    ?>


                    <?php
                } else {
                    if (isset($_GET['login'])) {
                    ?>
                        <button class="signup w-28 flex items-center justify-center h-12 px-3 py-1 border border-gray-600 rounded-full cursor-pointer mr-4" id="loginPop">
                            login
                        </button>
                    <?php
                    } else {


                    ?>

                        <button class="signup w-28 flex items-center justify-center h-12 px-3 py-1 border border-gray-600 rounded-full cursor-pointer mr-4" id="signUpPop">
                            signup
                        </button>
                <?php
                    }
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
                    <div class="small-cards w-20 h-24 rounded-md bg-white mr-2 bg-opacity-50">
                        <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                    </div>
                    <div class="small-cards w-20 h-24 rounded-md bg-white mr-2 bg-opacity-50">
                        <img src="./assets/featured/7.png" class="w-full h-full object-contain" alt="">
                    </div>
                    <div class="small-cards w-20 h-24 rounded-md bg-white bg-opacity-50">
                        <img src="./assets/featured/burger2.png" class="w-full h-full object-contain" alt="">
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
            <div class="main-section-banner bg-gray-900 h-52 rounded-lg flex flex-col px-10 py-5 relative overflow-hidden">

                <div class="absolute top-0 left-0 right-0 bottom-0 h-full w-full overflow-hidden">
                    <img class="object-contain h-full w-full transform translate-x-1/4" src="./assets/featured/image2.png" alt="Featured Black Friday">
                </div>
                <?php // TODO Change Customer Name Here 

                if (isset($_SESSION['sessionId'])) {
                    $sql = "SELECT * FROM customer WHERE id = " . $_SESSION['sessionId'] . ";";
                    $results = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($results);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            if ($row['name'] != null) {
                ?>
                                <h2 class="text-gray-100 text-xl">Hello, <?php echo $row['name']; ?>!</h2>
                <?php
                            }
                        }
                    }
                }
                ?>
                <h4 class="w-1/2 text-2xl text-gray-200 my-2">It's <span class="font-extrabold text-red-500">Black Friday</span>, Win Execlusive Offers. Up to <span class="text-red-600 font-black mx-1">40%</span> Discounts.</h4>
                <button class="button mt-2 bg-white text-yellow-500 font-bold cursor-pointer w-36 h-10 rounded-full flex items-center justify-center transform transition hover:bg-yellow-500 duration-300 hover:text-gray-50">
                    Explore
                </button>
            </div>
        </section>

        <!-- Menu Category -->
        <div class="menu-category mt-10 xl:container xl:mx-auto">
            <h1 class="text-3xl font-bold text-gray-700">All Burgers</h1>
            <!-- Category Cards -->
            <?php  // TODO : Future Implementataions 
            ?>
            <!-- <div class="cat-cards flex mt-6">
                <?php
                // $categories = array();
                // array_push($categories, 'Shipwreck Burger');
                // array_push($categories, 'The Good Fellas');
                // array_push($categories, "Boss's Daughter");
                // array_push($categories, "Machine Gun Tommy");
                // array_push($categories, "The Big Poppa");
                // foreach ($categories as $category) {
                ?>
                <div class="cursor-pointer card mr-5 flex flex-col items-center py-2 w-36 h-44 relative bg-gray-50 rounded-xl shadow-sm hover:shadow-md px-2">
                    <div class="w-14 h-14 my-2">
                        <img src="./assets/icons/Untitled-1.png" class="w-full h-full object-contain" alt="food-icon">
                    </div>
                    <h3 class="text-gray-700 text-center text-base font-bold"><?php //echo $category; 
                                                                                ?></h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-2 left-1/2 transform -translate-x-1/2 mt-2 h-8 w-8 rounded-full p-2 bg-yellow-500 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <?php
                //}
                ?>
            </div> -->




            <!-- Foods -->
            <div class="foods my-12 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-3 2xl:gap-1 xl:container xl:mx-auto">

                <!-- Foods Cards -->

                <?php

                $sql = "select * from food left join (select count(*), food_id, ingredient_id from ingredient_food join ingredient on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units  < ingredient.remaining_units group by food_id) as total_ing on total_ing.food_id = food.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, food_id from ingredient_food group by food_id) as final_ing on final_ing.food_id = food.id where total_ing.ingredient_id in (select id from ingredient join ingredient_food on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units < ingredient.remaining_units);";
                $results = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($results);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {

                        if ($row['count(*)'] >= $row['counts_ing']) {



                ?>
                            <div class="card-food mb-5 w-64 h-72 px-2 py-4 rounded-lg bg-gray-50 bg-opacity-40 shadow-md flex flex-col items-center relative cursor-pointer transform transition hover:scale-105 duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-red-300 rounded-full text-red-500 p-2 absolute top-2 left-3 cursor-pointer transform transition duration-200 hover:bg-red-400 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <p class="hidden food-id"><?php echo $row['food_id'] ?></p>
                                <div class="w-3h-36 h-36">
                                    <img src="./photo_uploads/foods/<?php echo $row['photo']; ?>" alt="Food Today's Special" class="w-full h-full object-contain">
                                </div>
                                <!-- <h3 class="text-2xl font-bold text-gray-600 text-center -mt-4 mb-1">Cheese Burger Haloween Special</h3> -->
                                <h3 class="text-lg font-bold text-gray-600 text-center -mt-0 mb-1"><?php echo $row['name']; ?></h3>
                                <div class="stars text-yellow-500 flex">
                                    <?php
                                    for ($i = 0; $i < $row['rating']; $i++) {
                                    ?>

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <h3 class="text-xl font-bold text-gray-500 mt-1 absolute bottom-2 left-3">Rs.<?php echo $row['basic_price']; ?></h3>

                                <div class="plus-button absolute bottom-2 right-3 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-yellow-400 rounded-full text-gray-100 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>

                <?php
                        }
                    }
                }

                ?>


            </div>
        </div>
    </main>
    <script src="./scripts/customer-signup.js"></script>
    <script src="./scripts/common.js"></script>
    <?php
    if (isset($_SESSION['sessionId'])) {
    ?>
        <script src="./scripts/food-customize.js"></script>

    <?php
    }
    ?>
    <script src="./scripts/cart.js"></script>
    <script src="./scripts/customer-profile.js"></script>
    <script>
        console.log("Works");
    </script>
</body>

</html>