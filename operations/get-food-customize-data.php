<?php

include '../config.php';


function Render($results, $conn)
{

    while ($row = mysqli_fetch_assoc($results)) {
?>
        <button class="fixed h-14 w-14 rounded-full bg-black top-1 md:top-6 right-1 md:right-8 flex justify-center items-center text-white z-50 transform transition active:scale-90 duration-150" id="CloseCustomMenu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Header -->
        <header class="flex flex-col xl:flex-row xl:container xl:mx-auto h-screen">
            <div class="left flex flex-col xl:flex-1">
                <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Customize</h1>

                <div class="flex items-center justify-center">
                    <img src="./photo_uploads/foods/<?php echo $row['photo']; ?>" class="w-4/5 xl:w-4/5 2xl:w-full" alt="Featured-Food">
                </div>
            </div>

            <div class="right relative flex xl:justify-center flex-col flex-1">
                <h1 class="text-2xl md:text-5xl lg:text-7xl xl:text-5xl text-gray-200 font-bold"><?php echo $row['name']; ?></h1>
                <p class="text-justify text-gray-300 text-base md:text-xl xl:text-base my-2 md:my-6 lg:my-10 xl:my-3"><?php echo $row['description']; ?></p>
                <h3 class="uppercase font-semibold text-2xl text-gray-200 tracking-widest">Topping</h3>
                <div class="flex my-2 md:my-4 flex-wrap overflow-y-auto toppings">
                    <?php


                    $sql = "select * from filling";
                    $resultsFilling = mysqli_query($conn, $sql);
                    $resultCheckFilling = mysqli_num_rows($resultsFilling);

                    if ($resultCheckFilling > 0) {
                        while ($rowFilling = mysqli_fetch_assoc($resultsFilling)) {

                    ?>

                            <button class="flex px-3 py-2 rounded-full border border-gray-300 text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <?php echo $rowFilling['name'];  ?>
                            </button>

                        <?php

                        }
                    }
                ?>

                </div>
                <div class="flex justify-between items-center">
                    <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                        <button class="transition duration-150 hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        <p class="mx-3 font-bold text-2xl">0</p>
                        <button class="transition duration-150 hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                            </svg>
                        </button>
                    </div>
                    <h2 class="text-4xl text-gray-100 font-semibold">Rs.<?php echo $row['basic_price']; ?>/<span class="text-sm">each</span></h2>
                </div>
                <button disabled class="rounded-br-none fixed bottom-5 right-10 explore flex text-gray-100 bg-black py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold disabled:opacity-50" id="checkout" onclick="goCheckout()">Add to cart<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg></button>

                <div class="-bottom-full bounce-err fixed left-1/2 explore flex text-gray-100 bg-red-500 py-3 px-5 rounded justify-center items-center mt-5 font-semibold disabled:opacity-50 error">Please select at least one topping</div>
            </div>
        </header>
        <?php
    }
}

if (isset($_POST['id'])) {

    $sql;
    $results;
    $message;
    $id = $_POST['id'];

    $sql = " select * from food where id = $id;";
    $results = mysqli_query($conn, $sql);
    $message = "No Results Found For Name -" . $_POST['id'];


    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results, $conn);
        } else {

        ?>
            <h1 class="text-center text-xs font-semibold text-gray-400 w-full mt-6"><?php echo $message; ?></h1>
        <?php
        }
    } else {
        ?>
        <h1 class="text-center text-xs font-semibold text-gray-400 w-full mt-6"><?php echo $message; ?></h1>
<?php
    }
} else {
    echo 'Something went wrong';
}
?>