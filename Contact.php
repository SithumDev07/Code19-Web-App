<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Papa's Kitchen</title>
    <link rel="stylesheet" href="./public/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
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
    <header class="fixed top-0 left-0 right-0 z-50">
        <nav class="relative w-screen h-28 flex items-center justify-end lg:justify-center text-white xl:px-24">
            <a href="/code19/foodMain.php" class="absolute top-1/2 transform -translate-y-1/2 left-12 p-2 rounded-full bg-blue-600 text-gray-50 transition duration-200 hover:bg-red-500 hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
            </a>
        </nav>
    </header>
    <main class="h-screen w-screen overflow-x-hidden font-Aventra py-12 px-14">
        <div class="container mx-auto">
            <div class="flex flex-col">
                <h1 class="text-center text-4xl text-blue-600 font-extrabold tracking-wide">Get in touch</h1>
                <p class="text-center mt-2 text-gray-700">Contact us for any issue. Or join to the team.</p>

                <div class="flex flex-wrap -mx-3 overflow-hidden mt-10">
                    <div class="my-3 py-8 px-3 w-full overflow-hidden flex flex-col justify-center items-center lg:w-1/3 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-gray-50 transform transition duration-100">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <p class="text-xl mt-3 font-bold">Papa's Kitchen, Katugastota, Kandy</p>
                    </div>
                    <div class="my-3 py-8 px-3 w-full overflow-hidden flex flex-col justify-center items-center lg:w-1/3 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-gray-50 transform transition duration-100">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>

                        <p class="text-xl mt-3 font-bold">+94 81 523 6333</p>
                    </div>
                    <div class="my-3 py-8 px-3 w-full overflow-hidden flex flex-col justify-center items-center lg:w-1/3 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-gray-50 transform transition duration-100">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>

                        <p class="text-xl mt-3 font-bold">support@papaskitchen.com</p>
                    </div>
                </div>
            </div>

            <div class="border border-blue-500 rounded-2xl px-10 py-8 mt-10">
                <div class="flex flex-wrap -mx-5 overflow-hidden">
                    <div class="my-5 px-5 w-full overflow-hidden lg:w-1/2 flex flex-col">
                        <div class="mb-5">
                            <p class="mb-3 text-blue-600 font-bold tracking-wide text-xl">Name</p>
                            <input type="text" placeholder="Name" class="text-gray-200 rounded-md w-full px-3 py-3 bg-transparent border border-gray-200 placeholder-gray-500" name="name">
                        </div>
                        <div class="mb-5">
                            <p class="mb-3 text-blue-600 font-bold tracking-wide text-xl">Phone</p>
                            <input type="text" placeholder="Phone" class="text-gray-200 rounded-md w-full px-3 py-3 bg-transparent border border-gray-200 placeholder-gray-500" name="phone">
                        </div>
                        <div class="mb-5">
                            <p class="mb-3 text-blue-600 font-bold tracking-wide text-xl">Email</p>
                            <input type="text" placeholder="Email" class="text-gray-200 rounded-md w-full px-3 py-3 bg-transparent border border-gray-200 placeholder-gray-500" name="email">
                        </div>
                    </div>
                    <div class="my-5 px-5 w-full overflow-hidden lg:w-1/2 flex flex-col">
                        <p class="mb-3 text-blue-600 font-bold tracking-wide text-xl">Message</p>
                        <textarea type="text" placeholder="Message" class="text-gray-200 rounded-md w-full px-3 py-3 bg-transparent border border-gray-200 placeholder-gray-500 h-56" name="message"></textarea>

                        <button type="submit" class="relative w-full rounded-md mt-4 flex items-center justify-center bg-blue-600 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-blue-700 transition duration-300" id="SignupCustomer">
                            Send
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute top-1/2 right-5 transform -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>

    </script>
</body>

</html>