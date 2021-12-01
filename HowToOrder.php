<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to order? - Papa's Kitchen</title>
    <link rel="stylesheet" href="./public/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url('./assets/backgrounds/bg\ \(Large\).jpg');
            background-size: cover;
            background-position: center;
            /* background-repeat: no-repeat; */
            min-width: 100vh;
            margin: 0;
            padding: 0;
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

        .featured-clipped {
            clip-path: circle(40%);
        }
    </style>
</head>

<body class="font-Aventra overflow-x-hidden">
    <main class="glass">
        <header class="fixed top-0 left-0 right-0 z-50">
            <nav class="relative w-screen h-28 flex items-center justify-end lg:justify-center text-white xl:px-24">
                <a href="/code19/foodMain.php" class="absolute top-1/2 transform -translate-y-1/2 left-12 p-2 rounded-full bg-gray-100 text-gray-800 transition duration-200 hover:bg-red-500 hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-semibold tracking-wider">How to order?</h1>
                </div>
            </nav>
        </header>
        <?php //* Featured 
        ?>
        <section class="Featured pt-36 container mx-auto">
            <div class="flex flex-wrap -mx-1 overflow-hidden">
                <div class="my-1 px-1 w-full overflow-hidden lg:w-2/5 xl:w-2/5">
                    <div class="w-96 h-80 overflow-hidden rounded-2xl">

                        <img class="object-cover" src="./assets/howtoorder/signup.JPG" alt="Featured Burger One">
                    </div>
                </div>
                <div class="my-1 px-1 w-full overflow-hidden lg:w-3/5 xl:w-3/5 flex flex-1 items-center justify-center text-gray-200">
                    <div class="px-6 py-5 rounded-full bg-red-600 mr-6">
                        <p class="text-3xl font-bold text-gray-50">01</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-center text-2xl 3/4">Frst Create an account by clicking <span class="text-red-500 font-semibold">signup</span> button. If you are already signed in then you can log into your existing account.</span></p>
                        <p class="flex items-center text-right text-base w-1/2 text-blue-700 mt-5 font-bold">Your data is secure with us<span class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g>
                                            <path d="M86,14.33333l-64.5,28.66667v25.1765c0,40.60275 25.98275,76.65108 64.5,89.49017v0c38.51725,-12.83908 64.5,-48.88742 64.5,-89.49017v-25.1765z" fill="#1d4ed8"></path>
                                            <path d="M86,142.40525c-30.19675,-12.11525 -50.16667,-41.35883 -50.16667,-74.22875v-15.85983l50.16667,-22.29908l50.16667,22.29908v15.86342c0,32.86633 -19.96992,62.10992 -50.16667,74.22517z" fill="#2100c4"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span></p>
                    </div>
                </div>

            </div>
            <div class="flex flex-wrap -mx-1 overflow-hidden mt-8">

                <div class="my-1 px-1 w-full overflow-hidden lg:w-3/5 xl:w-3/5 flex flex-1 items-center justify-center text-gray-200">
                    <div class="px-6 py-5 rounded-full bg-red-600 mr-6">
                        <p class="text-3xl font-bold text-gray-50">02</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-center text-2xl 3/4">Scroll down to all foods section and click your <span class="text-red-500 font-semibold">favourite</span> food card.</span></p>
                        <p class="flex items-center text-right text-base w-1/2 text-blue-700 mt-5 font-bold">Best burgers in town <span class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g fill="#1d4ed8">
                                            <path d="M156.5372,78.93653l-5.2116,-3.12467c-2.2188,-1.33013 -3.72093,-3.526 -4.39747,-6.02c-0.01147,-0.04587 -0.02293,-0.09173 -0.04013,-0.1376c-0.69373,-2.51693 -0.48733,-5.20013 0.77973,-7.48773l2.95267,-5.3148c3.01573,-5.4352 -0.84853,-12.126 -7.06347,-12.2292l-6.13467,-0.1032c-2.5972,-0.04587 -5.0052,-1.19827 -6.83987,-3.03293c-0.0172,-0.0172 -0.04013,-0.04013 -0.05733,-0.05733c-1.8404,-1.83467 -2.9928,-4.24267 -3.03293,-6.83987l-0.1032,-6.13467c-0.10893,-6.2264 -6.79973,-10.09067 -12.23493,-7.0692l-5.3148,2.95267c-2.28187,1.26707 -4.96507,1.47347 -7.48773,0.77973c-0.04587,-0.01147 -0.09173,-0.02293 -0.1376,-0.04013c-2.494,-0.68227 -4.68987,-2.17867 -6.02,-4.39747l-3.12467,-5.2116c-3.1992,-5.332 -10.922,-5.332 -14.1212,0l-3.1132,5.18867c-1.3416,2.236 -3.55467,3.74387 -6.06587,4.43187c-0.02867,0.00573 -0.0516,0.0172 -0.08027,0.02293c-2.53987,0.69947 -5.24027,0.49307 -7.54507,-0.78547l-5.2976,-2.9412c-5.4352,-3.02147 -12.126,0.8428 -12.2292,7.05773l-0.1032,6.13467c-0.04587,2.5972 -1.19827,5.0052 -3.03293,6.83987c-0.0172,0.0172 -0.04013,0.04013 -0.05733,0.05733c-1.83467,1.8404 -4.24267,2.9928 -6.83987,3.03293l-6.13467,0.1032c-6.22067,0.10893 -10.08493,6.79973 -7.06347,12.23493l2.95267,5.3148c1.26707,2.2876 1.47347,4.96507 0.77973,7.48773c-0.01147,0.04587 -0.02293,0.09173 -0.04013,0.1376c-0.68227,2.494 -2.17867,4.68987 -4.39747,6.02l-5.2116,3.12467c-5.332,3.1992 -5.332,10.92773 0,14.1212l5.2116,3.1304c2.2188,1.33013 3.72093,3.526 4.39747,6.02c0.01147,0.04587 0.02293,0.09173 0.04013,0.1376c0.69373,2.52267 0.48733,5.20013 -0.77973,7.48773l-2.95267,5.32627c-3.01573,5.4352 0.84853,12.126 7.06347,12.2292l6.13467,0.1032c2.5972,0.04587 5.0052,1.19827 6.83987,3.03293c0.0172,0.0172 0.04013,0.04013 0.05733,0.05733c1.8404,1.83467 2.9928,4.24267 3.03293,6.83987l0.1032,6.12893c0.1032,6.21493 6.794,10.0792 12.2292,7.06347l5.3148,-2.95267c2.28187,-1.26707 4.96507,-1.47347 7.48773,-0.77973c0.04587,0.01147 0.09173,0.02293 0.1376,0.04013c2.494,0.68227 4.68987,2.17867 6.02,4.39747l3.12467,5.2116c3.1992,5.332 10.922,5.332 14.1212,0l3.12467,-5.2116c1.33013,-2.2188 3.526,-3.72093 6.02,-4.39747c0.04587,-0.01147 0.09173,-0.02293 0.1376,-0.04013c2.51693,-0.69373 5.20013,-0.48733 7.48773,0.77973l5.3148,2.95267c5.4352,3.01573 12.126,-0.84853 12.2292,-7.06347l0.1032,-6.12893c0.04587,-2.5972 1.19827,-5.0052 3.03293,-6.83987c0.0172,-0.0172 0.04013,-0.04013 0.05733,-0.05733c1.83467,-1.8404 4.24267,-2.9928 6.83987,-3.03293l6.13467,-0.1032c6.21493,-0.1032 10.0792,-6.794 7.06347,-12.2292l-2.95267,-5.3148c-1.26707,-2.2876 -1.47347,-4.96507 -0.77973,-7.48773c0.01147,-0.04587 0.02293,-0.09173 0.04013,-0.1376c0.68227,-2.494 2.17867,-4.68987 4.39747,-6.02l5.2116,-3.1304c5.3492,-3.1992 5.3492,-10.92773 0.02293,-14.12693zM118.72013,72.85347l-37.61067,37.61067c-1.07787,1.07787 -2.53413,1.67987 -4.05347,1.67987c-1.51933,0 -2.98133,-0.602 -4.05347,-1.67987l-19.7972,-19.7972c-2.24173,-2.24173 -2.24173,-5.8652 0,-8.10693c2.24173,-2.24173 5.8652,-2.24173 8.10693,0l15.74373,15.74373l33.5572,-33.5572c2.24173,-2.24173 5.8652,-2.24173 8.10693,0c2.24173,2.24173 2.24173,5.8652 0,8.10693z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span></p>
                    </div>
                </div>
                <div class="my-1 px-1 w-full overflow-hidden lg:w-2/5 xl:w-2/5">
                    <div class="w-96 h-80 overflow-hidden rounded-2xl">

                        <img class="object-cover" src="./assets/howtoorder/favourite.JPG" alt="Featured Burger One">
                    </div>
                </div>

            </div>
            <div class="flex flex-wrap -mx-1 overflow-hidden mt-8">
                <div class="my-1 px-1 w-full overflow-hidden lg:w-2/5 xl:w-2/5">
                    <div class="w-96 h-80 overflow-hidden rounded-2xl">

                        <img class="object-cover" src="./assets/howtoorder/customize.png" alt="Featured Burger One">
                    </div>
                </div>
                <div class="my-1 px-1 w-full overflow-hidden lg:w-3/5 xl:w-3/5 flex flex-1 items-center justify-center text-gray-200">
                    <div class="px-6 py-5 rounded-full bg-red-600 mr-6">
                        <p class="text-3xl font-bold text-gray-50">03</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-center text-2xl 3/4">Customize your <span class="text-red-500 font-semibold">burger</span> in your prefered way. then click checkout.</span></p>
                        <p class="flex items-center text-right text-base w-1/2 text-blue-700 mt-5 font-bold">Dont't add limitaions to your food <span class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g fill="#1d4ed8">
                                            <path d="M64.5,21.5c-23.7145,0 -43,19.2855 -43,43h129c0,-23.7145 -19.2855,-43 -43,-43zM28.66667,79.0153c-2.98244,0 -5.96496,0.86451 -8.35645,2.58952l-6.00488,4.33919l8.38444,11.61783l5.97689,-4.32519l5.97689,4.32519l1.87565,1.35775h2.32357l-0.58789,-0.19596c0.20045,0.04633 0.40565,0.0808 0.60189,0.13997l-0.014,0.05599h0.18197c2.71031,0.78074 5.24021,0.78074 7.95052,0h14.02539l-5.76693,-4.15723l2.09961,-1.52571l5.97689,4.32519c4.78296,3.45 11.92992,3.45 16.71289,0l5.97689,-4.32519l5.97689,4.32519c4.78297,3.45 11.92993,3.45 16.7129,0l5.97689,-4.32519l5.97689,4.32519c4.78297,3.45 11.92993,3.45 16.7129,0l5.97689,-4.32519l5.97689,4.32519l8.38444,-11.61783l-6.00488,-4.33919c-4.78297,-3.45 -11.92993,-3.45 -16.7129,0l-5.97689,4.32519h-0.014l-5.96289,-4.32519c-4.78297,-3.45 -11.92993,-3.45 -16.7129,0l-5.97689,4.32519h-0.014l-5.96289,-4.32519c-4.78297,-3.45 -11.92993,-3.45 -16.7129,0l-5.97689,4.32519h-0.014l-5.96289,-4.32519c-4.78296,-3.45 -11.92993,-3.45 -16.71289,0l-5.97689,4.31119l-5.97689,-4.31119c-2.39148,-1.725 -5.374,-2.58952 -8.35645,-2.58952zM21.5,114.66667v14.33333c0,11.85367 9.64633,21.5 21.5,21.5h86c11.85367,0 21.5,-9.64633 21.5,-21.5v-14.33333z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span></p>
                    </div>
                </div>


            </div>
            <div class="flex flex-wrap -mx-1 overflow-hidden mt-8">

                <div class="my-1 px-1 w-full overflow-hidden lg:w-3/5 xl:w-3/5 flex flex-1 items-center justify-center text-gray-200">
                    <div class="px-6 py-5 rounded-full bg-red-600 mr-6">
                        <p class="text-3xl font-bold text-gray-50">04</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-center text-2xl 3/4">Pay for your food in your easiest way. Also you can order for takeaways.</p>
                        <p class="flex items-center text-right text-base w-1/2 text-blue-700 mt-5 font-bold">Pay with secure, fast and easiest way <span class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g fill="#1d4ed8">
                                            <path d="M28.66667,28.66667c-7.91917,0 -14.33333,6.41417 -14.33333,14.33333v7.16667h143.33333v-7.16667c0,-7.91917 -6.41417,-14.33333 -14.33333,-14.33333zM14.33333,71.66667v57.33333c0,7.91917 6.41417,14.33333 14.33333,14.33333h114.66667c7.91917,0 14.33333,-6.41417 14.33333,-14.33333v-57.33333zM107.5,93.16667c2.623,0 5.0525,0.76213 7.16667,1.98763c2.11417,-1.2255 4.54367,-1.98763 7.16667,-1.98763c7.91917,0 14.33333,6.41417 14.33333,14.33333c0,7.91917 -6.41417,14.33333 -14.33333,14.33333c-2.623,0 -5.0525,-0.76213 -7.16667,-1.98763c-2.11417,1.2255 -4.54367,1.98763 -7.16667,1.98763c-7.91917,0 -14.33333,-6.41417 -14.33333,-14.33333c0,-7.91917 6.41417,-14.33333 14.33333,-14.33333zM114.66667,119.8457c3.95748,0 7.16588,-5.52696 7.16667,-12.3457c-0.00079,-6.81874 -3.20918,-12.3457 -7.16667,-12.3457c-3.95748,0 -7.16588,5.52696 -7.16667,12.3457c0.00079,6.81874 3.20918,12.3457 7.16667,12.3457z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span></p>
                    </div>
                </div>
                <div class="my-1 px-1 w-full overflow-hidden lg:w-2/5 xl:w-2/5">
                    <div class="w-96 h-80 overflow-hidden rounded-2xl">

                        <img class="object-cover" src="./assets/howtoorder/checkout.png" alt="Featured Burger One">
                    </div>
                </div>

            </div>
        </section>

    </main>
    <script src="./scripts/distortion-scroll.js"></script>
</body>

</html>