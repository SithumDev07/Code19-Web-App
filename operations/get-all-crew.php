<?php
    include '../config.php';

    $currentUser = $_POST['currentUser'];
    $sql = "SELECT * FROM staff_member WHERE id != " . $currentUser . ";";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);

    if($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($results)) {
            ?> 
                <div class="card-crew mb-4 w-64 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                <p class="hidden card-crew-id"><?php echo $row['id']; ?></p>
                        <div class="absolute top-2 right-2 rounded-full px-3 py-1 bg-black text-gray-200 text-sm bg-opacity-60"><?php echo $row['shift']; ?></div>
                            <div class="flex justify-center mb-2">
                                <div class="overflow-hidden w-24 h-24 rounded-full mb-1 cursor-pointer mr-2">
                                    <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/<?php echo $row['photo']; ?>" alt="SupplierImage">
                                </div>
                            </div>
                            
                            <h1 class="text-gray-600 font-semibold text-center text-lg crew-name-card"><?php echo $row['name']; ?></h1>
                            <div class="my-1 text-center">
                                <h1 class="text-gray-500 font-semibold text-sm mb-1"><?php echo $row['position']; ?></h1>
                                <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                <p class="text-xs text-gray-400"><?php echo $row['personal_no']; ?></p>
                                <?php if($row['email'] !== null) {

                                    ?> 
                                        <p class="text-xs text-gray-400"><?php echo $row['email']; ?></p>
                                    <?php
                                } ?>
                                
                            </div>
                            <div class="text-xs text-gray-400 mb-1 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>    
                                <p class="crew-address-card"><?php echo $row['address']; ?></p>
                            </div>

                            <div class="flex items-center mt-2 justify-between">
                                    <?php
                                        date_default_timezone_set('Asia/Colombo');
                                        $date = date('m/d/Y h:i:s a', time());
                                        $date = substr($date, 3, 2);
                                        $due;
                                        if(($row['pay_date'] - $date) < 0) {
                                            $due = "Lost";
                                        }
                                        else if(($row['pay_date'] - $date) < 3 && ($row['pay_date'] - $date) > 0) {
                                            $due = "Hurry";
                                        } else {
                                            $due = "Fine";
                                        }
                                    ?>
                                <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo $due; ?>
                                </button>

                                <div class="text-gray-500 text-xs flex flex-col text-right">
                                    <h3 class="text-xl font-semibold text-gray-500 text-left"><?php if($row['Salary'] != null) { echo 'Rs. ' . number_format($row['Salary'], 2, '.', ','); } else { echo 'Rs. 0.00'; } ?></h3>
                                    Monthly Salary - Every <?php 
                                        $day = substr($row['pay_date'], 1, 2);
                                        if($day == 1) {
                                            echo $row['pay_date'] . "st";
                                        } else if($day == 2) {
                                            echo $row['pay_date'] . "nd";
                                        } else if($day == 3) {
                                            echo $row['pay_date'] . "rd";
                                        } else {
                                            echo $row['pay_date'] . "th";
                                        }

                                    ?>
                                    
                                </div>
                            </div>
                            <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                        </div>
        <?php               
                }
            } else {

                ?> 
                    <h1 class="text-center text-6xl font-semibold text-gray-400 w-full mt-6">No Results Found</h1>
                <?php
            }
?>