<?php

require_once 'layouts/header.php';

include 'config.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $emailAddress = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO usersphp(username, email, password) VALUES ('$username', '$emailAddress', '$password')";

    $result = $conn->query($sql);

    if ($result) echo "New record created";
    else echo "There was an error" . $conn->connect_error;
}

?>

<header class="container mx-auto my-24">
    <div class="w-full max-w-xs mx-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="./index.php" method="POST">
            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                <p class="text-red-500 text-xs italic hidden">Username is required</p>
            </div>
            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Email Address
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email address" name="email">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2""></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2""></i>
                <p class="text-red-500 text-xs italic hidden">Email address is required</p>
            </div>
            <div class="mb-6 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="password" type="password" placeholder="******************" name="password">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2""></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2""></i>
                <p class="text-red-500 text-xs italic hidden">Password is required</p>
            </div>
            <div class="mb-6 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Confirm Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="confirmedPassword" type="password" placeholder="******************">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2""></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2""></i>
                <p class="text-red-500 text-xs italic hidden">Please confirm your password</p>
            </div>
            <div class="flex items-center justify-between mb-6">
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
                <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id='submit' name="submit" value="Next" />
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
<script src="./scripts/signup.js"></script>
</body>

</html>