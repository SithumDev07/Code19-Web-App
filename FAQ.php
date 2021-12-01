<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - Papa's Kitchen</title>
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

        .featured-clipped {
            clip-path: circle(40%);
        }

        .height-change {
            height: 3rem;
            overflow: hidden;
            transition: height 0.3s cubic-bezier(0.445, 0.05, 0.55, 0.95);
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
            <div class="flex flex-wrap -mx-3 overflow-hidden">
                <div class="my-3 px-3 w-full overflow-hidden lg:w-2/5 xl:w-2/5">
                    <img src="./assets/faq/faq.png" alt="FAQ">
                </div>
                <div class="my-3 px-3 w-full overflow-hidden lg:w-3/5 xl:w-3/5">
                    <h1 class="text-4xl font-extrabold tracking-wide mb-1 text-gray-700">FAQs</h1>
                    <div class="w-20 h-1 bg-blue-600"></div>



                    <div class="faqs-section mt-10">

                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <img src="./assets/logo/main-page-logo.png" alt="LOGO">
                <h4 class="text-4xl text-gray-700 tracking-wide ml-3 font-extrabold">Papa's Kitchen</h4>
            </div>
        </div>
    </main>
    <script>
        function componentRender(index, title = "title", solution = "solution") {

            const component = document.createElement('div');
            component.classList.add(`faqs-container-${index}`);
            component.classList.add(`height-change`);
            component.classList.add(`flex`);
            component.classList.add(`flex-col`);
            component.classList.add(`mt-4`);

            component.innerHTML = `
            <div class="title-container flex items-center text-blue-600">
                                <h1 class="text-3xl font-semibold text-gray-900 mb-2">${title}</h1>
                                <div class="flex-1 flex justify-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer plus-${index} h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer minus-${index} h-10 w-10 hidden" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-base text-gray-600 w-3/4">${solution}</p>
            `;

            return component;
        }

        var faqs = [
            "Can I order foods without having an account?",
            "Can I order for takeaways?",
            "Can I delete my account permanently?",
            "I forgot my username and password",
            "Is cash on delivery available?"
        ];
        var solutions = [
            "No you have to have an account to order foods. By the way, your personal data is secure with us.",
            "Yes! You can select delivery method in the checkout page. When you order for takeaways, you don't have to pay online.",
            "Yes! You can delete your account permanently by clicking <span class='text-red-500 font-semibold'>Delete</span> option in your profile bottom section.",
            "Currently we don't provide option to recover your account, By the way you can contact our team and get support to recover your account.",
            "Sorry! We dont provide cash on delivery yet. But you can order for takeaways without paying online."
        ];

        faqs?.forEach((item, index) => {
            document.querySelector('.faqs-section')?.appendChild(componentRender(index + 1, item, solutions[index]));
            toggleIcon(index + 1)
        })

        function toggleIcon(index) {

            document.querySelector(`.plus-${index}`).addEventListener('click', () => {
                document.querySelector(`.faqs-container-${index}`).classList.toggle('height-change')
                document.querySelector(`.plus-${index}`).classList.toggle('hidden')
                document.querySelector(`.minus-${index}`).classList.toggle('hidden')
            })

            document.querySelector(`.minus-${index}`).addEventListener('click', () => {
                document.querySelector(`.faqs-container-${index}`).classList.toggle('height-change')
                document.querySelector(`.plus-${index}`).classList.toggle('hidden')
                document.querySelector(`.minus-${index}`).classList.toggle('hidden')
            })
        }
    </script>
</body>

</html>