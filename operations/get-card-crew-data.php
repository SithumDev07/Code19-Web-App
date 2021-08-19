<?php

    include '../config.php';
    $id = $_POST['id'];
    $flex = $_POST['flex'];
    $sql = "SELECT * FROM staff_member WHERE id=" . $id . ";";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);

    if($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($results)) {
            
            
            
            ?> 
                <form id="crew-form" action="./operations/<?php echo 'update-crew'; ?>.php" method="post" enctype="multipart/form-data">
                            <div class="w-full h-full glass rounded-3xl p-10 <?php echo $_POST['marginTop']; ?> left-0 z-base-search absolute flex-col <?php echo $flex; ?> add-crew-form overflow-y-auto">
                                    <!-- Card Account -->
                                <div class="flex items-center">
                                    <div class="flex-1 flex flex-col px-12">
                                        <input type="text" placeholder="Full Name" class="mb-5 flex-1 rounded-md bg-gray-50" id="crewName" name="name" value="<?php echo $row['name']; ?>">
                                        <input type="email" placeholder="Email (Optional)" class="mb-5 flex-1 bg-gray-50 rounded-md transform transition-colors duration-300" id="crewEmail" name="email" value="<?php if($row['email'] != null) { echo $row['email']; } ?>">
                                        <textarea name="address" id="crewAddress" class="mb-5 appearance-none py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50 rounded-md transform transition-colors duration-300" placeholder="Address" id="crewAddress" name="address"><?php echo $row['address']; ?></textarea>
                                        
                                    
                                    </div>
                                    <div class="w-48 h-48 rounded-full overflow-hidden relative cursor-pointer profile-picture p-1 border-2 border-blue-600 CrewImageContainer shadow-2xl">
                                        <i class="fas fa-camera text-white absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-3xl z-10"></i>
                                        <img id="crewUploadedProfile" class="opacity-80 rounded-full w-full h-full object-cover" src="./photo_uploads/users/<?php echo $row['photo']; ?>" alt="Crew Profile">
                                        <input type="file" name="profileUpload" id="crewUploadProfile">
                                    </div>
                                </div>
                                <div class="mb-24 mt-5">
                                        <div class="flex items-center">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="birthday">
                                                Date of Birth
                                            </label>
                                            <input class="shadow appearance-none border rounded flex-1 mx-4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5" id="crewDOB" type="date" name="birthday" value="<?php echo $row['DOB']; ?>" required>
                                            
                                            <input type="number" placeholder="Personal Number" class="mx-4 mb-5 flex-1 bg-gray-50 rounded-md transform transition-colors duration-300" id="crewPersonalNumber" name="mobile" value="<?php echo $row['personal_no']; ?>">
                                            <input type="number" placeholder="Land Number (Optional)" class="mb-5 flex-1 bg-gray-50 rounded-md transform transition-colors duration-300" id="crewLandLine" name="landline" value="<?php if(!($row['LAN_no'] == null)){ echo $row['LAN_no'];} ?>">
                                        </div>

                                        <div class="flex items-center mb-5">
                                            <div class="flex flex-col">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                                                    Position
                                                </label>
                                                <select class="px-3 py-2 w-28 rounded" id="crewPosition" name="position">
                                                    <option value="Chef">Chef</option>
                                                    <!-- <option value="Staff">Staff</option> -->
                                                    <option value="Helper">Helper</option>
                                                    <!-- <option value="Manager">Manager</option> -->
                                                </select>
                                            </div>

                                            <div class="flex flex-col mx-5">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="shift">
                                                    Shift
                                                </label>
                                                <select class="px-3 py-2 w-28 rounded" id="crewShift" name="shift">
                                                    <option value="Day">Day</option>
                                                    <option value="Night">Night</option>
                                                </select>
                                            </div>

                                            <input type="number" placeholder="Salary" class="-mb-7 mx-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="crewSalary" name="salary" value="<?php if(!($row['Salary'] == null)){echo $row['Salary'];} else { echo '0'; } ?>">

                                            <div class="flex flex-col">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="payDate">
                                                    Pay Date
                                                </label>
                                                <div class="flex items-end">
                                                    <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="crewPayDate" placeholder="Day" type="number" name="payDate" value="<?php echo $row['paydate']; ?>" required>
                                                    <p class="ml-2 text-gray-500">in every month</p>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="flex justify-between items-center mb-48">
                                            <a href="./dashboard.php" class="flex items-center text-gray-900 font-bold mx-5 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95" id="CancelOpendedCrew">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                                                </svg>
                                                Cancel
                                            </a>
                                            <div class="flex items-center">
                                                <p class="text-red-500 font-semibold text-sm hidden crew-error-message">Oops. It seems to be some inputs are not valid.</p>
                                                <button class="flex items-center text-red-500 mx-5 bg-red-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-red-400 hover:text-gray-200" id="DeleteCrew" type="submit" name="crew-delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Delete
                                                </button>
                                                <button class="flex items-center text-yellow-500 mx-5 bg-yellow-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-yellow-400 hover:text-gray-200" id="UpdateCrew" type="submit" name="crew-update">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Update
                                                </button>
                                            </div>
                                            
                                        </div>
                                </div>
                            </div>
                        </form>
        <?php               
                }
            } else {

                ?> 
                    <h1 class="text-center text-6xl font-semibold text-gray-400 w-full mt-6">No Results Found</h1>
                <?php
            }
?>