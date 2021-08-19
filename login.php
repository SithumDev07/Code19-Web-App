<?php

require_once 'layouts/header.php';

include 'config.php';

session_start();

if(isset($_GET['clear'])) {
    session_unset();
    // session_destroy();
}

?>

<header class="container mx-auto my-24">
    <div class="w-full max-w-xs mx-auto">   
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="./includes/login-inc.php" method="POST">
        <!-- <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"> -->
            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                <p class="text-red-500 text-xs italic hidden">Username is required</p>
                <p class="text-red-500 text-xs italic" id="alreadyTaken"><?php if(isset($_GET['error']) && $_GET['error'] == 'user_not_found') { echo 'Username is wrong.'; } ?></p>
            </div>
            <div class="mb-6 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="password" type="password" placeholder="******************" name="password">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                <p class="text-red-500 text-xs italic hidden">Password is required</p>
                <p class="text-red-500 text-xs italic" id="alreadyTaken"><?php if(isset($_GET['error']) && $_GET['error'] == 'wrong_password') { echo 'Password is wrong. Try again.'; } ?></p>
            </div>
            <div class="flex items-center justify-between mb-6">
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
                <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id='login' name="submit" value="Login" />
            </div>
            <p class="inline-block align-baseline font-bold text-sm text-gray-500">
                Don't have an account? <a href="./signup.php" class="text-blue-500 hover:text-blue-800 ml-1">Sign Up</a>
            </p>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2021 Code19. All rights reserved.
        </p>
    </div>
</header>
</main>
<script src="./scripts/common.js"></script>
<script src="./scripts/login.js"></script>
</body>

</html>