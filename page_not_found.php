<?php
// session_start();
// require_once './includes/database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samadhi</title>
    <link rel="stylesheet" href="./public/style.css">
    <link rel="stylesheet" href="./styles/loginStyle.css">
</head>

<body>
    <main class="h-screen">
        <nav class="bg-white shadow-xl fixed z-50 top-0 left-0 right-0">
            <div class="container mx-auto flex items-center justify-between p-5">
                <div class="logo">
                    <img src="" alt="">
                </div>
                <ul class="links flex items-center">
                    <li><a href="./register.php" class="text-blue-800 text-sm">Register</a></li>
                    <li><a href="./login.php" class="bg-blue-500 text-sm px-5 py-3 rounded-full ml-4 text-gray-200 transform transition duration-200 hover:bg-blue-600">Login</a></li>
                </ul>
            </div>
        </nav>
        <div class="container mx-auto flex flex-col items-center justify-center w-full h-full">
        <h1 class="text-8xl font-extralight text-gray-500 text-center">Server isn't Connected 😭</h1>
        <h1 class="text-xl font-semibold text-blue-500 text-center mt-10">👀 Please contact <a href="#">CODE19</a> 🛠</h1>
        <?php if(isset($_GET['error'])) {
            ?>
            <h1 class="text-sm font-semibold text-gray-500 text-center mt-10">Tell them that it says, <p class="text-red-500 text-sm font-bold"><?php echo $_GET['error']; ?></p></h1>
            <?php
        } ?>
        
        </div>
    </main>
    <script src="./scripts/common.js"></script>
    <script src="./scripts/loginForm.js"></script>
</body>

</html>