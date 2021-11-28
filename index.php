<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management</title>
    <link rel="stylesheet" href="./public/style.css">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body class="h-screen overflow-hidden">

    <main class="bg-white h-screen overflow-hidden">
        <div class="bg-white">
            <nav class="h-16 container mx-auto flex">
                <div class="logo w-20 h-16 p-2 mr-10 flex items-center justify-center">
                    <img class="w-full h-full object-contain" src="https://cdn.worldvectorlogo.com/logos/tailwindcss.svg" alt="Logo">
                </div>
                <ul class="text-gray-600 flex flex-1 justify-end items-center">
                    <li class="ml-8">
                        <a href="/">Solutions</a>
                    </li>
                    <li class="ml-8">
                        <a href="/">FAQ</a>
                    </li>
                    <li class="ml-8">
                        <?php
                            if(isset($_SESSION['sessionUser'])) {

                                ?>
                                <h1><?php echo $_SESSION['sessionUser']; ?></h1>
                                <a href="./login.php?username=<?php echo $_SESSION['sessionUser']; ?>" class="bg-yellow-400 px-4 text-sm py-2 font-bold text-white rounded-full cursor-pointer hover:bg-yellow-500">Login</a>
                            <?php
                            } else {

                                ?>
                            <a href="./signup.php" class="bg-yellow-400 px-4 text-sm py-2 font-bold text-white rounded-full cursor-pointer hover:bg-yellow-500">Sign Up</a>
                                <?php
                            }
                        ?>
                        
                    </li>
                </ul>
            </nav>
        </div>



        <header class="container mx-auto">
            <div class="mt-12 ml-16">
                <h1 class="text-gray-700 font-sans font-bold text-6xl w-1/2">Gain more control over your business</h1>
                <p class="text-gray-500 font-sans font-bold text-base w-1/2 mt-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, id omnis? Illum eligendi cumque eius.</p>
                <div class="mt-8 flex absolute z-10">
                    <div class="bg-yellow-500 w-36 text-sm px-3 py-2 rounded-full flex items-center justify-center font-bold text-white cursor-pointer hover:bg-yellow-600 mr-4">Get started</div>
                    <div class="border border-gray-400 w-36 text-sm px-3 py-2 rounded-full flex items-center justify-center font-bold text-gray-400 cursor-pointer hover:bg-yellow-600 hover:text-white hover:border-yellow-600">How it works?</div>
                </div>
                <!-- <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_yyjaansa.json" background="transparent" speed="0.5" class="w-full h-full -mt-12" autoplay loop> -->
                <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_yyjaansa.json" background="transparent" speed="0.5" class="absolute left-0 right-0 z-30 xl:top-1/3 2xl:top-1/4" autoplay loop>

                </lottie-player>
            </div>

        </header>
    </main>

    <?php require_once 'layouts/footer.php' ?>