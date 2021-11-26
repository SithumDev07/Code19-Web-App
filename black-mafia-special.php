<?php



?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Mafia Special</title>
    <link rel="stylesheet" href="./public/style.css">
    <style>
        .featured-clipped {
            clip-path: circle(40%);
        }
    </style>
</head>

<body class="w-screen overflow-x-hidden font-Aventra bg-black">
    <main>
        <header class="fixed top-0 left-0 right-0 z-50">
            <nav class="relative w-screen h-28 flex items-center justify-center bg-black text-white px-24">
                <a href="/code19/foodMain.php" class="absolute top-1/2 transform -translate-y-1/2 left-12 p-2 rounded-full bg-gray-100 text-gray-800 transition duration-200 hover:bg-red-500 hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                </a>
                <ul class="flex items-center justify-between w-1/2 font-Aventra transform transition duration-200">
                    <li><a href="#peakyDeals">Peaky Deals</a></li>
                    <li class="relative">
                        <a href="#blackFriday">Black Friday <div class="bg-red-600 px-2 absolute -top-5 -right-4 rounded-3xl text-gray-50" style="font-size: x-small; padding-top: 0.25rem; padding-bottom: 0.25rem;">new</div></a>
                    </li>
                    <li><a href="#tag">Tag 'n Win</a></li>
                    <li><a href="#mafia">What Mafia Says?</a></li>
                </ul>
                <a href="/gallery" class="px-3 py-2 bg-red-600 rounded-full transform transition duration-200 hover:bg-red-700 hover:bg-opacity-70 ml-12">Gallery</a>
            </nav>
        </header>
        <section class="bg-black w-screen mt-28">
            <div class="w-full flex items-center justify-start overflow-hidden" style="height: 495px;">
                <img src="./assets/featured/burger-mafia.jpg" alt="Burger Mafia Featured" class="object-cover">
            </div>
            <div class="text-center flex justify-center flex-col text-gray-200 mt-14 mb-8">
                <h1 class="text-4xl font-semibold tracking-widest uppercase mb-2">Dangereously Good Burgers</h1>
                <p class="text-xl tracking-wider">&#8212; Burger Mafia &#8212;</p>
            </div>
        </section>
        <?php //* Featured 
        ?>
        <section class="Featured">
            <div class="flex flex-wrap -mx-1 overflow-hidden">
                <div class="my-1 px-1 w-full overflow-hidden lg:w-1/2 xl:w-1/2 flex items-center justify-center text-gray-200">
                    <p class="text-center text-2xl w-1/2">Our Hitman packs some serious guns - 180gms of juicy and meaty double beef patty. <span class="text-red-500 font-bold">Can you handle it?</span></p>
                </div>
                <div class="my-1 px-1 w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                    <img class="featured-clipped" src="./assets/featured/featured1.jpg" alt="Featured Burger One">
                </div>
            </div>
        </section>
        <section class="Featured-Two">
            <div class="flex flex-wrap -mx-1 overflow-hidden">
                <div class="my-1 px-1 w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                    <img class="featured-clipped" src="./assets/featured/featured2.jpg" alt="Featured Burger One">
                </div>
                <div class="my-1 px-1 w-full overflow-hidden lg:w-1/2 xl:w-1/2 flex items-center justify-center text-gray-200">
                    <p class="text-center text-2xl w-1/2">Say hello to our little friend - <span class="text-red-500 font-bold">The Scarface!</span> This bad boy is sure to deliver an explosion of flavours in your mouth - the kind that keeps you coming back for more!</span></p>
                </div>
            </div>
        </section>
        <section id="tag">
            <div class="flex justify-center">
                <video type="video/mp4" autoplay loop style="height: 350px;">
                    <source src="./assets/featured/featured-video.mp4">
                </video>
            </div>
            <p class="flex flex-col text-gray-200 w-1/2 mx-auto text-xl">
                Here's How: <br>
                - Follow Burger Mafia page <br>
                - Take a screenshot when the picture of the burger is perfectly aligned with the grid outline <br>
                - Send us the screenshot via DM <br>
                - Tag two fellas you want to share a dangerously good meal with (make sure they are following BM page too) <br>
                <br><br>
                <span class="text-center">Winners will be picked on the 1st of October 2021</span> <br>

                <span class="text-center">T&C apply</span>
            </p>
        </section>
        <section id="mafia">
            <div class="mt-28 mb-8">
                <p class="text-gray-100 text-3xl text-center tracking-wider">What <span class="text-red-500 font-semibold">Mafia</span> Says?</p>
            </div>
            <div class="w-3/4 mx-auto px-10">
                <div class="flex flex-wrap -mx-5 overflow-hidden text-gray-200">
                    <div class="my-5 px-5 w-full overflow-hidden md:w-1/3 lg:w-1/3 xl:w-1/3">
                        <div class="flex justify-center">
                            <img width="150px" height="auto" class="featured-clipped" src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Keanu_Reeves_2013_%2810615146086%29_%28cropped%29.jpg" alt="Profile1 3Xl">
                        </div>
                        <h1 class="-mt-6 text-lg text-red-500 font-semibold text-center 3xl:text-xl capitalize">keanu <span class="text-gray-100">reeves</span></h1>
                        <p class="text-gray-100 text-sm mt-2 text-center">We absolutely <span class="text-red-500 font-semibold">love</span> it when our mobsters are happy with the food we make for them, that's what keeps us going!</p>
                    </div>
                    <div class="my-5 px-5 w-full overflow-hidden md:w-1/3 lg:w-1/3 xl:w-1/3">
                        <div class="flex justify-center">
                            <img width="150px" height="auto" class="featured-clipped" src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Keanu_Reeves_2013_%2810615146086%29_%28cropped%29.jpg" alt="Profile1 3Xl">
                        </div>
                        <h1 class="-mt-6 text-lg text-red-500 font-semibold text-center 3xl:text-xl capitalize">keanu <span class="text-gray-100">reeves</span></h1>
                        <p class="text-gray-100 text-sm mt-2 text-center">We absolutely <span class="text-red-500 font-semibold">love</span> it when our mobsters are happy with the food we make for them, that's what keeps us going!</p>
                    </div>
                    <div class="my-5 px-5 w-full overflow-hidden md:w-1/3 lg:w-1/3 xl:w-1/3">
                        <div class="flex justify-center">
                            <img width="150px" height="auto" class="featured-clipped" src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Keanu_Reeves_2013_%2810615146086%29_%28cropped%29.jpg" alt="Profile1 3Xl">
                        </div>
                        <h1 class="-mt-6 text-lg text-red-500 font-semibold text-center 3xl:text-xl capitalize">keanu <span class="text-gray-100">reeves</span></h1>
                        <p class="text-gray-100 text-sm mt-2 text-center">We absolutely <span class="text-red-500 font-semibold">love</span> it when our mobsters are happy with the food we make for them, that's what keeps us going!</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>