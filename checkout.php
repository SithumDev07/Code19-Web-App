<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Special</title>
    <link rel="stylesheet" href="./public/style.css">
    <style>
        body {
            background-image: url('./assets/backgrounds/bg\ \(Large\).jpg');
            background-size: cover;
            background-position: center;
            /* background-repeat: no-repeat; */
            /* min-width: 100vh; */
        }

        /* Opacity pass it a as a variable */
        .glass {
            /* background-color: white; */
            background-image: linear-gradient(to right bottom, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            z-index: 2;
            backdrop-filter: blur(2rem);
        }

        .topping-error {
            bottom: -20%;
            transition: all 0.5s ease-in;
        }

        .topping-error-active {
            animation: popup 1s forwards 1s;
        }

        @keyframes popup {
            0% {
                bottom: -100%;
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            100% {
                bottom: 5rem;
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
        }

        .cart::-webkit-scrollbar {
            width: 0.6em;
            border-radius: 50%;
        }

        .cart::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .cart::-webkit-scrollbar-thumb {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 1.2em;
        }

        .add-card-active {
            height: auto;
        }
    </style>
</head>

<body class="md:overflow-hidden h-full md:h-screen">
    <main class="glass px-3 md:px-10 py-1 h-full">

        <a href="./customizeFoodMenu.php" class="fixed h-14 w-14 rounded-full bg-black top-1 md:top-6 left-1 md:left-6 flex justify-center items-center text-white cursor-pointer z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>

        <!-- Header -->
        <header class="flex flex-col xl:flex-row xl:container xl:mx-auto h-screen">
            <div class="left flex flex-col xl:flex-1 px-2">
                <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Checkout</h1>

                <div class="cart overflow-y-auto">
                    <div class="payment w-full h-auto border rounded-md p-6 my-4">
                        <div class="flex flex-col overflow-hidden h-48 add-card">
                            <div class="flex">
                                <div class="credit-card w-72 h-44 rounded-2xl flex flex-col p-3 justify-between bg-primary relative overflow-hidden">
                                    <div class="flex justify-between relative">
                                        <div class="w-6 h-6 rounded-full bg-gray-50 opacity-40"></div>
                                        <div class="w-6 h-6 rounded-full bg-gray-50 absolute top-0 left-4 z-10"></div>
                                        <h4 class="uppercase font-semibold text-gray-100 text-xl">visa</h4>
                                    </div>
                                    <h3 class="font-semibold text-2xl text-gray-200">8956 1254 8995</h3>
                                    <div class="flex justify-between">
                                        <h3 class="uppercase font-semibold text-gray-200 text-sm">Your Name</h3>
                                        <h3 class="uppercase font-semibold text-gray-200 text-sm z-20">09/23</h3>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 absolute -bottom-20 -right-16 text-blue-400 z-10" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>

                                <div class="w-44 h-44 rounded-2xl border-dotted border-2 border-gray-200 ml-5 flex items-center justify-center">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 bg-opacity-10 flex items-center justify-center text-gray-100">
                                        <button class="transform transition duration-200 hover:scale-110" onclick="activateAddSection()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col my-4">
                                <h1 class='text-gray-200 text-2xl font-semibold mb-3'>Add new card</h1>
                                <form action="">
                                    <input type="text" name="nameOnCard" id="nameOnCard" placeholder="Name on card" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-full mb-3">
                                    <div class="flex justify-between">
                                        <input type="text" name="nameOnCard" id="nameOnCard" placeholder="Card number" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-80 mb-3">
                                        <input type="text" name="nameOnCard" id="nameOnCard" placeholder="Expiration date" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 mb-3">
                                    </div>
                                    <div class="flex justify-between">
                                        <input type="text" name="nameOnCard" id="nameOnCard" placeholder="CVC" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4 w-64 mb-3">
                                        <p class="text-base text-gray-200 font-thin ml-5">By clicking confirm "I agree to the company's <a href="terms.html" class='text-black font-medium'>terms and services.</a></p>
                                    </div>
                                    <div class="flex justify-between">
                                        <button class="px-5 py-3 text-red-600 rounded-md ml-4" onclick="activateAddSection()">Cancel</button>
                                        <button class="px-5 py-3 bg-black rounded-md ml-4 text-white transition duration-150 hover:shadow-lg">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="text" class="border-0 bg-gray-800 bg-opacity-50 placeholder-gray-100 text-white outline-none rounded-md py-3 px-4" placeholder="Discount Code">
                        <button class="px-5 py-3 bg-black rounded-md ml-4 text-white transition duration-150 hover:shadow-lg">Apply</button>
                    </div>

                    <div class="flex flex-col my-4 text-gray-100 text-xl bg-gray-800 bg-opacity-20 p-3 rounded-xl">
                        <div class="flex justify-between border-b py-3">
                            <h3>Total</h3>
                            <h3>$490</h3>
                        </div>
                        <div class="flex justify-between my-2">
                            <h3>Delivery Charges</h3>
                            <h3 class="text-green-500">+ $20</h3>
                        </div>
                        <div class="flex justify-between border-b py-3">
                            <h3>Discount</h3>
                            <h3 class="text-red-500">- $490</h3>
                        </div>
                        <div class="flex justify-between mt-3 text-3xl font-bold">
                            <h2>Total Amount</h2>
                            <h2>$560</h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="right relative flex xl:justify-center flex-col flex-1 p-2">
                <div class="cart w-full h-auto border rounded-md p-6 overflow-y-auto">
                    <div class="cart-card w-full h-auto rounded-lg border flex items-center px-3 py-4 pr-5 mb-6">
                        <div class="w-32 h-32">
                            <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                        </div>
                        <div class="conetent flex flex-col flex-1 border-l border-r px-3">
                            <h1 class="text-xl font-bold text-gray-100">Cheese Burger Haloween Special (XL)</h1>
                            <div class="flex flex-wrap">
                                <button class="flex px-3 py-2 rounded-full bg-black text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-1 mt-3 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Cheese
                                </button>
                            </div>
                        </div>
                        <div class="pricing flex flex-col pl-3 items-center">
                            <h1 class="text-gray-100 font-semibold text-2xl">$12/<span class="text-sm">each</span></h1>
                            <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                                <p class="mx-3 font-bold text-xl">07</p>
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                    </svg>
                                </button>
                            </div>
                            <button class="text-red-600 text-lg font-bold shadow-sm">Remove</button>
                        </div>
                    </div>
                    <div class="cart-card w-full h-auto rounded-lg border flex items-center px-3 py-4 pr-5 mb-6">
                        <div class="w-32 h-32">
                            <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                        </div>
                        <div class="conetent flex flex-col flex-1 border-l border-r px-3">
                            <h1 class="text-xl font-bold text-gray-100">Cheese Burger Haloween Special (XL)</h1>
                            <div class="flex flex-wrap">
                                <button class="flex px-3 py-2 rounded-full bg-black text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-1 mt-3 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Cheese
                                </button>
                            </div>
                        </div>
                        <div class="pricing flex flex-col pl-3 items-center">
                            <h1 class="text-gray-100 font-semibold text-2xl">$12/<span class="text-sm">each</span></h1>
                            <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                                <p class="mx-3 font-bold text-xl">07</p>
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                    </svg>
                                </button>
                            </div>
                            <button class="text-red-600 text-lg font-bold shadow-sm">Remove</button>
                        </div>
                    </div>
                    <div class="cart-card w-full h-auto rounded-lg border flex items-center px-3 py-4 pr-5 mb-6">
                        <div class="w-32 h-32">
                            <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                        </div>
                        <div class="conetent flex flex-col flex-1 border-l border-r px-3">
                            <h1 class="text-xl font-bold text-gray-100">Cheese Burger Haloween Special (XL)</h1>
                            <div class="flex flex-wrap">
                                <button class="flex px-3 py-2 rounded-full bg-black text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-1 mt-3 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Cheese
                                </button>
                            </div>
                        </div>
                        <div class="pricing flex flex-col pl-3 items-center">
                            <h1 class="text-gray-100 font-semibold text-2xl">$12/<span class="text-sm">each</span></h1>
                            <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                                <p class="mx-3 font-bold text-xl">07</p>
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                    </svg>
                                </button>
                            </div>
                            <button class="text-red-600 text-lg font-bold shadow-sm">Remove</button>
                        </div>
                    </div>
                    <div class="cart-card w-full h-auto rounded-lg border flex items-center px-3 py-4 pr-5 mb-6">
                        <div class="w-32 h-32">
                            <img src="./assets/featured/featured-burger.png" class="w-full h-full object-contain" alt="">
                        </div>
                        <div class="conetent flex flex-col flex-1 border-l border-r px-3">
                            <h1 class="text-xl font-bold text-gray-100">Cheese Burger Haloween Special (XL)</h1>
                            <div class="flex flex-wrap">
                                <button class="flex px-3 py-2 rounded-full bg-black text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-1 mt-3 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Cheese
                                </button>
                            </div>
                        </div>
                        <div class="pricing flex flex-col pl-3 items-center">
                            <h1 class="text-gray-100 font-semibold text-2xl">$12/<span class="text-sm">each</span></h1>
                            <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                                <p class="mx-3 font-bold text-xl">07</p>
                                <button class="transition duration-150 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                    </svg>
                                </button>
                            </div>
                            <button class="text-red-600 text-lg font-bold shadow-sm">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <button class="rounded-br-none fixed bottom-5 right-10 explore flex text-gray-100 bg-black py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold disabled:opacity-50">Confirm Payment $560 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg></button>
        </header>
    </main>


    <script>
        function activateAddSection() {
            const addCardSection = document.querySelector('.add-card');
            addCardSection.classList.toggle('h-48');
            addCardSection.classList.toggle('add-card-active');
        }
    </script>
</body>

</html>