<?php

require_once 'layouts/header.php';

?>

<header class="container mx-auto my-24">
    <div class="w-full max-w-xs mx-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="./includes/register-inc.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Email Address
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="email" placeholder="Email address" name="email">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="password" type="password" placeholder="******************" name="password">
                <!-- <p class="text-red-500 text-xs italic">Please choose a password.</p> -->
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Confirm Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="password" type="password" placeholder="******************" name="confirmPassword">
                <?php
                if (isset($_GET['error'])) {
                    echo "<p class='text-red-500 text-xs italic'>Please choose a password.</p>";
                }

                ?>

            </div>
            <div class="flex items-center justify-between mb-6">
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
                    Next
                </button>
            </div>
            <p class="inline-block align-baseline font-bold text-sm text-gray-500">
                Already have an account? <a href="" class="text-blue-500 hover:text-blue-800 ml-1">Sign in</a>
            </p>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2021 Code19. All rights reserved.
        </p>
    </div>
</header>


</main>

<?php

require_once 'layouts/footer.php';
