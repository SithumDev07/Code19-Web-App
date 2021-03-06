<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./public/style.css">

    <style>
        .success {
            border-color: rgba(16, 185, 129, 1);
        }

        .listening {
            border-color: rgba(251, 191, 36, 1);
        }

        .error {
            border-color: rgba(239, 68, 68, 1);
        }

        .fa-check-circle {
            visibility: hidden;
        }

        .fa-exclamation-circle {
            visibility: hidden;
        }

        .fa-camera {
            top: 150%;
            transition: top 0.4s ease-in-out;
        }

        <?php

        if (isset($_GET['stepthree'])) {

        ?>.profile-picture:hover>i {
            top: 50%;
        }

        #upload-profile {
            position: absolute;
            top: 0;
            z-index: 10;
            width: 6rem;
            height: 6rem;
            opacity: 0;
            left: 0;
            cursor: pointer;
        }

        #upload-profile::-webkit-file-upload-button {
            visibility: hidden;
        }

        <?php

        }

        if (isset($_GET['error']) && $_GET['error'] == 'restricted') {
        ?>.blur-error {
            opacity: .1;
        }

        <?php
        }
        ?>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'restricted') {
    ?>
        <div class="restricted fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-64 bg-white flex flex-col items-center justify-center shadow-xl z-50 rounded">
            <h1 class="text-2xl font-semibold text-gray-500">Please Login</h1>
            <button class="text-white px-10 py-2 bg-yellow-400 rounded mt-5" id="restricted">Ok</button>
        </div>
    <?php
    }
    ?>
    <main class="bg-white blur-error">
        <div class="bg-white border-b fixed top-0 left-0 right-0 z-20">
            <nav class="h-16 container mx-auto flex">
                <div class="logo w-20 h-16 p-2 mr-10 flex items-center justify-center">
                    <img class="w-full h-full object-contain" src="https://cdn.worldvectorlogo.com/logos/tailwindcss.svg" alt="Logo">
                </div>
                <ul class="text-gray-600 flex flex-1 justify-end items-center">
                    <li class="ml-8">
                        <a href="./Contact.php">Contact</a>
                    </li>
                    <li class="ml-8">
                        <a href="./FAQ.php">FAQ</a>
                    </li>
                    <li class="ml-8">
                        <a href="./signup.php" class="bg-yellow-400 px-4 text-sm py-2 font-bold text-white rounded-full cursor-pointer hover:bg-yellow-500">Sign Up</a>
                    </li>
                </ul>
            </nav>
        </div>