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

        .topping-error-active {
            animation: popup 1s linear;
        }

        @keyframes popup {
            0% {
                transform: translateY(-100%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            100% {
                transform: translateY(100%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
        }
    </style>
</head>

<body class="md:overflow-hidden h-full md:h-screen">
    <main class="glass px-3 md:px-10 py-1 h-full">

        <div class="fixed h-14 w-14 rounded-full bg-black top-1 md:top-6 right-1 md:right-8 flex justify-center items-center text-white cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <!-- Header -->
        <header class="flex flex-col xl:flex-row xl:container xl:mx-auto h-screen">
            <div class="left flex flex-col xl:flex-1">
                <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Customize</h1>

                <div class="flex items-center justify-center">
                    <img src="./assets/featured/featured-burger.png" class="w-4/5 xl:w-full" alt="Featured-Food">
                </div>
            </div>

            <div class="right relative flex xl:justify-center flex-col flex-1">
                <h1 class="text-2xl md:text-5xl lg:text-7xl xl:text-5xl text-gray-200 font-bold">Cheese Burger Haloween Special (XL)</h1>
                <p class="text-justify text-gray-300 text-base md:text-xl xl:text-base my-2 md:my-6 lg:my-10 xl:my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus nobis tenetur, voluptate, dolor excepturi architecto, necessitatibus doloribus quo est laboriosam nisi. Recusandae animi qui exercitationem et atque assumenda, commodi mollitia?</p>
                <h3 class="uppercase font-semibold text-2xl text-gray-200 tracking-widest">Topping</h3>
                <div class="flex my-2 md:my-4 flex-wrap">
                    <?php
                    $toppings = array("Cheese", "Chilli Sauce", "Mushrooms", "Cuttle Fish", "Olives", "Capsicum", "Halloween Special Salad");
                    foreach ($toppings as $topping) {
                        $id = preg_replace('/\s+/', '', $topping);
                    ?>
                        <button class="flex px-3 py-2 rounded-full border border-gray-300 text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3" id="<?php echo $id; ?>" onclick="setActive(`<?php echo $id; ?>`);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <?php echo $topping;  ?>
                        </button>

                    <?php
                        $id++;
                    }
                    ?>
                </div>
                <button class="rounded-br-none fixed bottom-5 right-10 explore flex text-gray-100 bg-black w-36 py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold disabled:opacity-50" id="checkout">Checkout <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg></button>

                <div class="-bottom-full motion-safe:animate-bounce fixed left-1/2 explore flex text-gray-100 bg-red-500 py-3 px-5 rounded justify-center items-center mt-5 font-semibold disabled:opacity-50 error">Please select at least one topping</div>
            </div>
        </header>
    </main>
    <script>
        function setActive(id) {
            const topping = document.querySelector(`#${id}`);
            document.querySelector(`#${id}`).classList.toggle('bg-black');
            document.querySelector(`#${id}`).classList.toggle('border');
            document.querySelector(`#${id}`).classList.toggle('border-gray-300');

            topping.querySelector('svg').classList.toggle('hidden');
            console.log(id);
        }

        const checkout = document.querySelector('#checkout');
        checkout.addEventListener('click', () => {
            document.querySelector('.error').classList.remove('-bottom-full');
            document.querySelector('.error').classList.add('topping-error-active');
        })
    </script>
</body>

</html>