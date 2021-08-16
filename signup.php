<?php

require_once 'layouts/header.php';

include 'config.php';

$username;
$emailAddress;
$password;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $emailAddress = $_POST['email'];
    $password = $_POST['password'];

    // $sql = "INSERT INTO usersphp(username, email, password) VALUES ('$username', '$emailAddress', '$password')";

    // $result = $conn->query($sql);

    // if ($result) echo "New record created";
    // else echo "There was an error" . $conn->connect_error;
}

?>

<header class="container mx-auto my-24">
    <div class="w-full max-w-xs mx-auto">

    <?php 
        if(!isset($_GET['steptwo'])) {
            ?> 
            

            
            
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="./signup.php?steptwo" method="POST">
        <!-- <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"> -->
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
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                <p class="text-red-500 text-xs italic hidden">Email address is required</p>
            </div>
            <div class="mb-6 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="password" type="password" placeholder="******************" name="password">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                <p class="text-red-500 text-xs italic hidden">Password is required</p>
            </div>
            <div class="mb-6 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Confirm Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="confirmedPassword" type="password" placeholder="******************">
                <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class=" fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
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

        <?php
        }
    ?>


        <?php
            if(isset($_GET['steptwo'])) {
                
        ?>
        <h1><?php if(!empty($username)) { echo $username . ' ' . $emailAddress; } else echo 'They are not here'; ?></h1>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="./signup.php?stepthree" method="POST">
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                      First Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstName" type="text" placeholder="First name">
                    <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                    <p class="text-red-500 text-xs italic hidden">FirstName is required</p>
                  </div>
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                      Last Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastName" type="text" placeholder="Last name">
                    <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                    <p class="text-red-500 text-xs italic hidden">Last Name is required</p>
                  </div>
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      Address
                    </label>
                    <textarea name="address" id="address" class="hadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" placeholder="Address"></textarea>
                    <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                    <p class="text-red-500 text-xs italic hidden">Address is required</p>
                  </div>
                  <div class="mb-6 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      Date of Birth
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-1" id="DOB" type="date" required>
                    <!-- <i class="fas fa-check-circle text-green-500 absolute top-10 right-2""></i>
                    <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2""></i> -->
                    <p class="text-red-500 text-xs italic hidden">Please confirm your password</p>
                  </div>
                  <div class="flex items-center justify-between mb-6">
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                      Forgot Password?
                    </a>
                    <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id='submit' value="Next" />
                  </div>
                  <p class="inline-block align-baseline font-bold text-sm text-gray-500">
                    Already have an account? <a class="text-blue-500 hover:text-blue-800 ml-1" id="signin">Sign in</a>
                  </p>
                </form>

        <?php

            } else if(isset($_GET['stepthree'])) {

            ?>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="./index.php" method="POST">
                    <div class="mb-4 relative text-center flex flex-col justify-center items-center">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                          Profile Picture
                        </label>
                       <div class="w-24 h-24 rounded-full overflow-hidden relative cursor-pointer profile-picture">
                            <i class="fas fa-camera text-white absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl z-10"></i>
                            <img id="profile" class="opacity-50" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="Profile">
                            <input type="file" name="profileUpload" id="upload-profile">
                        </div>
                        <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                        <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                        <p class="text-red-500 text-xs italic hidden">Only Supports for .jpeg .png .pdf only</p>
                      </div>
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                      Mobile
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mobile" type="tel" placeholder="Ex: +94 7X XXX XXX X">
                    <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                    <p class="text-red-500 text-xs italic hidden">Mobile Phone is required</p>
                  </div>
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                      Home (Optional)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="landLine" type="text" placeholder="Ex: +94 3X XXX XXX X">
                    <i class="fas fa-check-circle text-green-500 absolute top-10 right-2"></i>
                    <i class="fas fa-exclamation-circle text-red-500 absolute top-10 right-2"></i>
                    <p class="text-red-500 text-xs italic hidden">Phone number is not valid</p>
                  </div>
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      Position
                    </label>
                    <select class="px-3 py-2 w-28 rounded" id="position">
                        <option value="Chef">Chef</option>
                        <option value="Staff">Staff</option>
                        <option value="Helper">Helper</option>
                        <option value="Manager">Manager</option>
                      </select>
                    <p class="text-red-500 text-xs italic hidden">Position is required</p>
                  </div>
                  <div class="mb-4 relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      Shift
                    </label>
                    <select class="px-3 py-2 w-28 rounded" id="shift">
                        <option value="Chef">Day</option>
                        <option value="Staff">Night</option>
                      </select>
                    <p class="text-red-500 text-xs italic hidden">Shift is required</p>
                  </div>
                  
                  <div class="flex w-full items-center mb-4">
                    <input type="checkbox" class="rounded text-blue-700 cursor-pointer focus:outline-none" id="agreement" />
                    <label class="block text-gray-700 text-sm font-bold ml-2" for="password">
                        I agree to the <a href="terms" class="text-blue-700">terms & conditions</a>
                      </label>
                </div>

                  <div class="flex items-center justify-between mb-6">
                    
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer disabled:opacity-40" id='submit' disabled >Finish</button>
                  </div>
                  <p class="inline-block align-baseline font-bold text-sm text-gray-500">
                    Already have an account? <a class="text-blue-500 hover:text-blue-800 ml-1" id="signin">Sign in</a>
                  </p>
                </form>


            <?php


            }
        ?>
        <p class="text-center text-gray-500 text-xs">
            &copy;2021 Code19. All rights reserved.
        </p>
    </div>
</header>
</main>
<script src="./scripts/common.js"></script>
<?php
    if(!isset($_GET['steptwo'])) {
        ?>
    <script src="./scripts/signup.js"></script>
        <?php
    }
?>
</body>

</html>