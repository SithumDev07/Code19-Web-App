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

        .error {
            border-color: rgba(239, 68, 68, 1);
        }

        .fa-check-circle {
            visibility: hidden;
        }

        .fa-exclamation-circle {
            visibility: hidden;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <main class="bg-white">
        <div class="bg-white border-b fixed top-0 left-0 right-0 z-20">
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
                        <a href="/" class="bg-yellow-400 px-4 text-sm py-2 font-bold text-white rounded-full cursor-pointer hover:bg-yellow-500">Sign Up</a>
                    </li>
                </ul>
            </nav>
        </div>