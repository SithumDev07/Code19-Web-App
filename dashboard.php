<?php
session_start();
require_once './config.php';

if (!isset($_SESSION['sessionId'])) {
    header("Location: ./signup.php?error=restricted");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
    <style>
        body{
            background-color: #DFE1EE;
        }
        .glass {
            background-image: linear-gradient(to right bottom, rgba(235,235,245,0.8), rgba(255,255,255,0.1));
            z-index: 2;
            backdrop-filter: blur(2rem);
        }
        .side-nav::-webkit-scrollbar {
            width: 0.6em;
            border-radius: 50%;
        }

        .side-nav::-webkit-scrollbar-track {
            /* box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
        }

        .side-nav::-webkit-scrollbar-thumb {
            background-color: rgba(30, 30, 30, 0.3);
            border-radius: 1.2em;
        }
        .moving-part::-webkit-scrollbar {
            width: 0.6em;
            border-radius: 50%;
        }

        .moving-part::-webkit-scrollbar-track {
            /* box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
        }

        .moving-part::-webkit-scrollbar-thumb {
            background-color: rgba(30, 30, 30, 0.3);
            border-radius: 1.2em;
        }

        html {
            scroll-behavior: smooth;
        }
        input:focus {
            outline: none;
        }
        .card-one {
            background-image: linear-gradient(#FEC345, #FFB41A);
        }
        canvas {
            width: auto !important;
            height: 350px !important;
        }
        .dashboard {
            transition: all 1 ease;
            /* transform: scale(1); */
        }
        .orders {
            transition: all 1 ease;
            /* transform: scale(1); */
        }
        .z-3 {
            z-index: 3;
            /* transform: scale(.5); */
        }

        .z-4 {
            z-index: 4; 
        }
        .z-5 {
            z-index: 5; 
        }
        .z-6 {
            z-index: 6; 
        }
        .z-7 {
            z-index: 7; 
        }
        .z-8 {
            z-index: 8; 
        }
        .z-9 {
            z-index: 9; 
        }
        .z-base {
            z-index: 50; 
        }
    </style>
</head>
<body>
    <main class="flex glass h-screen overflow-hidden">
        <aside class="hidden xl:flex flex-col border w-72 p-5 h-screen overflow-hidden">
            <div>
                <h1 class="text-center font-semibold text-3xl text-blue-600" id="MainTitleChangable">Dashboard</h1>
                <div class="flex flex-col items-center mt-4 2xl:mt-6">
                    <?php 
                                $sql = "SELECT name, position, photo FROM staff_member;";
                                $results = mysqli_query($conn, $sql);
                                $resultCheck = mysqli_num_rows($results);
                                
                                if($resultCheck > 0) {
                                    while($row = mysqli_fetch_assoc($results)) {
                                        
                                        
                                        
                                        ?> 
                    <div class="overflow-hidden w-20 h-20 rounded-full mb-1 border-2 border-blue-600 p-1 cursor-pointer">
                         <img class="w-full h-full object-cover rounded-full" src="./photo_uploads/users/<?php echo $row['photo']; ?>" alt="Profile Picture">
                    </div>
                         
                    <h2 class="text-base font-semibold text-gray-500"><?php echo $row['name']; ?></h2>
                    <h4 class="text-sm font-light text-gray-500"><?php echo $row['position'] ?></h4>
                         <?php               
                                    }
                                }
                    ?>
                        <!-- <img class="w-full h-full object-cover rounded-full" src="https://images.unsplash.com/photo-1627660692856-bc032e058cc2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="Profile Picture"> -->
                </div>
            </div>

            <nav class="overflow-y-auto flex-1 mt-6 flex flex-col side-nav justify-between h-full">
                <ul class="relative">
                    <li class="option-aside" style="height: 12.5%;">
                        <button class="flex w-full px-4 rounded-lg rounded-l-none bg-transparent py-3 transform transition duration-200 active:scale-95 overflow-hidden hover:bg-black hover:text-gray-200" id="dashboardSide">
                                
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Dashboard
                        </button>
                    </li>
                    <li class="option-aside" style="height: 12.5%;">
                        <button class="flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition duration-200 active:scale-95 hover:bg-black hover:text-gray-200" id="ordersSide">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                              </svg>
                            Orders
                        </button>
                    </li>
                    <li style="height: 12.5%;" class="option-aside">
                        <button class="flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition active:scale-95 duration-200 hover:bg-black hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                            Deliveries
                        </button>
                    </li>
                    <li style="height: 12.5%;" class="option-aside">
                        <button class=" flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition duration-200 hover:bg-black active:scale-95 hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            Inventory
                        </button>
                    </li>
                    <li style="height: 12.5%;" class="option-aside">
                        <button class="flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition duration-200 active:scale-95 hover:bg-black hover:text-gray-200">
                            <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="mr-4"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M20.5468 3.67162C20.1563 3.28109 19.5231 3.28109 19.1326 3.67162L13.7687 9.03555H2V11.0356H2.00842C2.22563 16.3663 6.61591 20.6213 12 20.6213C17.3841 20.6213 21.7744 16.3663 21.9916 11.0356H22V9.03555H16.5971L20.5468 5.08583C20.9374 4.69531 20.9374 4.06214 20.5468 3.67162ZM14.1762 11.0356C14.1806 11.0356 14.1851 11.0356 14.1896 11.0356H19.9895C19.7739 15.2613 16.2793 18.6213 12 18.6213C7.72066 18.6213 4.22609 15.2613 4.01054 11.0356H14.1762Z"
                            fill="currentColor"
                            />
                        </svg>
                            Kitchen
                        </button>
                    </li>
                    <li style="height: 12.5%;" class="option-aside ">
                       <button class="flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition duration-200 active:scale-95 hover:bg-black hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Suppliers
                       </button>
                    </li>
                    <li style="height: 12.5%;" class="option-aside">
                        <button class=" flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition duration-200 active:scale-95 hover:bg-black hover:text-gray-200">
                            <svg class="mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 11C10.2091 11 12 9.20914 12 7C12 4.79086 10.2091 3 8 3C5.79086 3 4 4.79086 4 7C4 9.20914 5.79086 11 8 11ZM8 9C9.10457 9 10 8.10457 10 7C10 5.89543 9.10457 5 8 5C6.89543 5 6 5.89543 6 7C6 8.10457 6.89543 9 8 9Z" fill="currentColor" /><path d="M11 14C11.5523 14 12 14.4477 12 15V21H14V15C14 13.3431 12.6569 12 11 12H5C3.34315 12 2 13.3431 2 15V21H4V15C4 14.4477 4.44772 14 5 14H11Z" fill="currentColor" /><path d="M22 11H16V13H22V11Z" fill="currentColor" /><path d="M16 15H22V17H16V15Z" fill="currentColor" /><path d="M22 7H16V9H22V7Z" fill="currentColor" /></svg>
                            Crew
                        </button>
                    </li>
                    <li style="height: 12.5%;" class="option-aside">
                        <button class=" flex w-full px-4 rounded-lg rounded-l-none cursor-pointer py-3 transform transition duration-200 active:scale-95 hover:bg-black hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </button>
                    </li>
                    <span class="absolute top-0 left-0 w-1 py-2 slide-aside transform transition-all duration-500" style="height: 12.5%;">
                        <div class="w-full h-full bg-black rounded-full"></div>            
                    </span>
                </ul>

                <a href="" class="flex mb-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                      </svg>
                    Log Out
                </a>
            </nav>
        </aside>

        <section class="flex-1 p-5 2xl:p-10">

            <div class="top-nav flex w-full items-center justify-between mb-8 2xl:mb-14 container mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>

                <div class="search-box w-96 bg-white flex overflow-hidden rounded-full px-4 py-2 items-center drop-shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    <input type="text" class="border-0 bg-transparent flex-1 p-1 outline-none" placeholder="Search">
                </div>

                <div class="buttons flex">
                    <a href="#" class="bg-white rounded-full p-2 shadow-lg transform transition duration-200 active:scale-75 relative">
                        <div class="absolute top-1 right-2 w-2 h-2 rounded-full bg-red-500 z-50"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                          </svg>
                    </a>
                    <a href="#" class="bg-white rounded-full p-2 shadow-lg ml-2 transform transition duration-200 active:scale-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                          </svg>
                    </a>
                    <a href="#" class="bg-white rounded-full p-2 shadow-lg ml-2 transform transition duration-200 active:scale-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                          </svg>
                    </a>
                    <a href="#" class="bg-white rounded-full p-2 shadow-lg ml-2 transform transition duration-200 active:scale-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </a>
                    <a href="#" class="bg-white rounded-full p-2 shadow-lg ml-2 transform transition duration-200 active:scale-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                          </svg>
                    </a>
                </div>
            </div>
            <div class="relative h-screen container mx-auto">


                <!-- Dashboard -->
                <div class="moving-part Dashboard glass rounded-3xl p-5 overflow-y-auto h-full absolute top-0 right-0 left-0 z-3">
                    <div class="greeting flex w-full justify-between items-center">
                    <?php 
                                    $sql = "SELECT name FROM staff_member;";
                                    $results = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($results);
                                    
                                    if($resultCheck > 0) {
                                        while($row = mysqli_fetch_assoc($results)) {
                                            
                                            
                                            
                                            ?> 
                        <h1 class="text-2xl text-gray-700 font-semibold">👋 Hello, <?php echo $row['name']; ?></h1>
                            <?php               
                                        }
                                    } else {
                                        header("Location: ../signup.php?error=restricted");
                                        exit();
                                    }
                        ?>
                        
                        <div class="flex items-center">
                            <a href="#" class="text-yellow-500 font-bold">View All</a>
                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Add Widget
                        </button>
                        </div>
                    </div>
                    <div class="cards flex flex-wrap mt-5 2xl:mt-8">
                        <!-- Random color array -->
                        <div class="card cursor-pointer card-one rounded-2xl bg-white p-5 shadow-2xl transform transition duration-200 hover:scale-105">
                            <div class="flex items-center justify-between">
                                <h1 class="text-lg font-semibold text-gray-800">Day Crew</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </div>
                            <div class="circles my-2 flex">
                                <div class=" mr-1 circle rounded-full overflow-hidden w-7 h-7">
                                    <img class="rounded-full w-full h-full object-cover" src="https://images.unsplash.com/photo-1592621385612-4d7129426394?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
                                </div>
                                <div class=" mr-1 circle rounded-full overflow-hidden w-7 h-7">
                                    <img class="rounded-full w-full h-full object-cover" src="https://images.unsplash.com/photo-1627754939597-ba460af0844f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
                                </div>
                                <div class=" mr-1 circle rounded-full overflow-hidden w-7 h-7">
                                    <img class="rounded-full w-full h-full object-cover" src="https://images.unsplash.com/photo-1628258946431-b99fbe144787?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
                                </div>
                            </div>
                            <div class="info flex items-center justify-between">
                                <div class="w-12 h-12 rounded-md bg-white shadow-md flex items-center justify-center text-xs font-bold text-gray-700 mr-2 p-1 text-center">
                                    64 More
                                </div>
                                <div class="info text-xs text-gray-700">
                                    Lorem ipsum dolor sit amet.
                                </div>
                            </div>
                        </div>
                        <div class="card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            <div>
                                <h1>Day Crew</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="circles">
                                <div class="circle"></div>
                            </div>
                            <div class="info">
                                <div>
                                    64 More
                                </div>
                                <div class="info">
                                    Lorem ipsum dolor sit amet.
                                </div>
                            </div>
                        </div>
                        <div class="card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            <div>
                                <h1>Day Crew</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="circles">
                                <div class="circle"></div>
                            </div>
                            <div class="info">
                                <div>
                                    64 More
                                </div>
                                <div class="info">
                                    Lorem ipsum dolor sit amet.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="charts mt-10 flex p-3 mb-36">
                        <div class="flex flex-col mr-2 flex-1">
                            <div class="chart">
                                <h1 class="text-2xl font-semibold text-gray-600 mb-5">Sales Overview</h1>
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="recent-activities mt-5">
                                <div class="row">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <h2>Name</h2>
                                    <h2>Description</h2>
                                    <h2>Amount</h2>
                                    <h2>Status</h2>
                                </div>
                            </div>
                        </div>

                        <div class="quick-orders-list p-5 rounded-2xl bg-gray-900 text-white w-96">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="text-xl font-semibold">Orders</h3>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </div>

                            <div class="headers flex items-center text-xs justify-between mb-6">
                                <p>Table No</p>
                                <p>Customer name</p>
                                <p>Description</p>
                                <p>Amount</p>
                                <p>Status</p>
                                <!-- Online or ... -->
                                <p>Type</p>
                            </div>

                            <div class="order-component w-11/12 h-20 px-3 py-3 rounded-xl border mx-auto">

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Orders -->
                <div class="moving-part Orders glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-4" id="stickyContainer">
                    <div class="greeting flex w-full justify-between items-center">
                    
                        <h1 class="text-2xl text-gray-700 font-semibold flex items-center">Orders <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 cursor-pointer transform transition duration-200 hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg></h1>
                        
                        <div class="flex items-center">
                            <a href="#" class="text-yellow-500 font-bold">View All</a>
                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Add Widget
                        </button>
                        </div>
                    </div>
                    <div>
                        <p class="mt-5 text-sm text-gray-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dignissimos quasi iure officia id, nam eum expedita dolores aliquid numquam quis minus non eligendi quibusdam inventore blanditiis assumenda tenetur voluptatibus. Animi.</p>
                    </div>
                   <div class="relative h-12 shadow-md mx-auto mt-5" style="width: 80%;">
                       <ul class="flex items-center h-full">
                           <li class="option all-orders block h-full text-center text-yellow-500 font-bold cursor-pointer" style="width: 20%;">All Orders</li>
                           <li class="option completed block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">Completed</li>
                           <li class="option continuing block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">Continuing</li>
                           <li class="option on-hold block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">On Hold</li>
                           <li class="option canceled block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">Canceled</li>
                       </ul>
                       <span class="underline-slide absolute bottom-0 left-0 h-1 bg-yellow-400 transform transition-all duration-500 rounded-xl" style="width: 20%;"></span>
                   </div>

                   <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0" id="stickySearch">
                        <input type="text" placeholder="Search for orderID, Customer, Order Status Or Something..." class="flex-1 rounded-md bg-transparent border transform transition-colors duration-300">
                        <button class="flex items-center text-gray-500 mx-5 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="filter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            Filters
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="export">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>

                            <div class="border border-gray-600 w-36 h-20 rounded-md absolute -bottom-24 right-0 flex-col shadow-md p-3 bg-gray-100 hidden exported">
                                <button class="flex items-center text-gray-500 text-sm border-b border-gray-500 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .xlsx
                                </button>
                                <button class="flex items-center text-gray-500 text-sm mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .doc
                                </button>
                            </div>
                        </div>
                   </div>

                   <!-- Table -->
                   <table class="rounded-t-lg w-full bg-transparent text-gray-800 mt-8">
                    <tr class="text-left border-b border-gray-500">
                        <th class="px-4 py-3">Order ID</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Extra notes</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Delivery Method</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                    <tr class="text-left border-b border-gray-500 text-sm">
                        <td class="px-4 py-3">#7898</td>
                        <td class="px-4 py-3">Sithum Basnayake</td>
                        <td class="px-4 py-3">Chicken Burger XL x2</td>
                        <td class="px-4 py-3">Mushrooms, Bacon, Ketchup</td>
                        <td class="px-4 py-3">Rs. 980.00</td>
                        <td class="px-4 py-3 text-center">Delivery</td>
                        <td class="px-4 py-3"><button class="px-3 py-2 bg-green-400 rounded text-gray-200">Accept</button></td>
                    </tr>
                   </table>
                </div>


                <!-- Deliveries -->
                <div class="moving-part Deliveries glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-5" id="stickyContainerDelivery">
                    <div class="greeting flex w-full justify-between items-center">
                        <h1 class="text-2xl text-gray-700 font-semibold">👋 Deliveries</h1>
                        
                        <div class="flex items-center">
                            <a href="#" class="text-yellow-500 font-bold">View All</a>
                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Add Widget
                        </button>
                        </div>
                    </div>

                    <!-- Search -->

                    <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0 z-50" id="stickySearchDelivery">
                        <input type="text" placeholder="Search for orderID, Customer, Order Status Or Something..." class="flex-1 rounded-md bg-transparent border transform transition-colors duration-300">
                        <button class="flex items-center text-gray-500 mx-5 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="filterDelivery">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            Filters
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="exportDelivery">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>

                            <div class="border border-gray-600 w-36 h-20 rounded-md absolute -bottom-24 right-0 flex-col shadow-md p-3 bg-gray-100 hidden exportedDelivery">
                                <button class="flex items-center text-gray-500 text-sm border-b border-gray-500 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .xlsx
                                </button>
                                <button class="flex items-center text-gray-500 text-sm mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .doc
                                </button>
                            </div>
                        </div>
                   </div>

                    <div class="relative h-12 shadow-md mx-auto mt-5" style="width: 80%;">
                       <ul class="flex items-center h-full">
                           <li class="option-delivery all-orders block h-full text-center text-yellow-500 font-bold cursor-pointer" style="width: 20%;">All Orders</li>
                           <li class="option-delivery completed block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">Completed</li>
                           <li class="option-delivery continuing block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">Continuing</li>
                           <li class="option-delivery on-hold block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">On Hold</li>
                           <li class="option-delivery canceled block h-full text-center text-gray-500 cursor-pointer" style="width: 20%;">Canceled</li>
                       </ul>
                       <span class="underline-slide-delivery absolute bottom-0 left-0 h-1 bg-yellow-400 transform transition-all duration-500 rounded-xl" style="width: 20%;"></span>
                   </div>

                    <div class="flex mt-5 mb-24">
                        <div class="left-delivery flex-1 flex flex-wrap">

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full overflow-hidden">
                                        <img class="object-cover" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="delivery">
                                    </div>
                                    <h1 class="text-gray-500 font-semibold mx-4 flex-1">2168454FAGT</h1>
                                    <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 p-2 rounded bg-blue-200 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                    </svg>
                                    </button>
                                </div>
                                <div class="flex flex-col flex-1 mt-2">
                                    <h1 class="text-gray-600 font-semibold">Mr. Sithum Basnayake</h1>
                                    <p class="text-sm text-gray-400">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim, cumque.</p>
                                    <p class="text-xs text-gray-500">Chicken Submarine XL x3, Chicken Subma...</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        12.00 p.m
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Delivering
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-yellow-400 left-0"></div>
                            </div>

                            <!-- End of card -->
                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full overflow-hidden">
                                        <img class="object-cover" src="./photo_uploads/users/Mayuko.jpg" alt="delivery">
                                    </div>
                                    <h1 class="text-gray-500 font-semibold mx-4 flex-1">2168454FAGT</h1>
                                    <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 p-2 rounded bg-blue-200 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                    </svg>
                                    </button>
                                </div>
                                <div class="flex flex-col flex-1 mt-2">
                                    <h1 class="text-gray-600 font-semibold">Ms. Myauko Inoiue</h1>
                                    <p class="text-sm text-gray-400">Third Avenue, Tokyo, Japan.</p>
                                    <p class="text-xs text-gray-500">Chicken Submarine XL x3, Chicken Subma...</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        11.20 p.m
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Delivered
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->
                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full overflow-hidden">
                                        <img class="object-cover" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="delivery">
                                    </div>
                                    <h1 class="text-gray-500 font-semibold mx-4 flex-1">2168454FAGT</h1>
                                    <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 p-2 rounded bg-blue-200 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                    </svg>
                                    </button>
                                </div>
                                <div class="flex flex-col flex-1 mt-2">
                                    <h1 class="text-gray-600 font-semibold">Mr. Sithum Basnayake</h1>
                                    <p class="text-sm text-gray-400">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim, cumque.</p>
                                    <p class="text-xs text-gray-500">Chicken Submarine XL x3, Chicken Subma...</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        12.00 p.m
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Delivering
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-red-400 left-0"></div>
                            </div>

                            <!-- End of card -->
                        </div>
                        <div class="right-map rounded-xl bg-white w-72 overflow-hidden hidden xl:inline-flex">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7923.136119299889!2d79.89118293959962!3d6.822269768053192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25ac61680bad9%3A0xb6dbdd061fb17aa8!2sSri%20Lanka%20Air%20Force%20Museum!5e0!3m2!1sen!2slk!4v1629235096894!5m2!1sen!2slk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>


                <!-- Inventory -->
                <div class="moving-part Inventory glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-6" id="stickyContainerInventory">
                    <div class="greeting flex w-full justify-between items-center">
                        <h1 class="text-2xl text-gray-700 font-semibold">🏪 Inventory</h1>

                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Add Ingredient
                        </button>
                    </div>

                    <div class="warning w-full rounded-xl bg-yellow-500 bg-opacity-30 my-5 flex items-center p-5">
                        <div class="flex-1">
                            <h1 class="text-2xl font-semibold text-gray-600">Total 12 Ingredients are running out</h1>
                            <button class="flex items-center text-sm mt-4">
                                Show
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-yellow-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <!-- Search -->

                    <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0 z-50" id="stickySearchInventory">
                        <input type="text" placeholder="Search for IngredientID, Ingredient Name Or Supplier..." class="flex-1 rounded-md bg-transparent border transform transition-colors duration-300">
                        <button class="flex items-center text-gray-500 mx-5 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="filterInventory">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            Filters
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="exportInventory">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>

                            <div class="border border-gray-600 w-36 h-20 rounded-md absolute -bottom-24 right-0 flex-col shadow-md p-3 bg-gray-100 hidden exportedInventory">
                                <button class="flex items-center text-gray-500 text-sm border-b border-gray-500 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .xlsx
                                </button>
                                <button class="flex items-center text-gray-500 text-sm mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .doc
                                </button>
                            </div>
                        </div>
                   </div>

                    <div class="flex mt-5 mb-24">
                        <div class="left-delivery flex-1 flex flex-wrap">

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="">
                                        <h1 class="text-gray-600 font-semibold">All Purpose Flour</h1>
                                        <p class="text-sm text-gray-500 font-bold my-1">Ranathunga Stores</p>
                                        <p class="text-xs text-gray-400">+94 76 6 108 500</p>
                                        <p class="text-xs text-gray-400">ranathunga@gmail.com</p>
                                    </div>
                                    <h1 class="flex-1 m-3 text-3xl font-semibold text-gray-600 text-center">48Kg</h1>
                                </div>

                                <div class="flex items-center">
                                    <h1 class="text-gray-500 font-semibold flex-1">Previous Stock</h1>
                                    <p class="text-gray-500 font-semibold">12th Aug</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        13Kg
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Average Consumtion
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-yellow-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="">
                                        <h1 class="text-gray-600 font-semibold">Mozeralla Cheese</h1>
                                        <p class="text-sm text-gray-500 font-bold my-1">Highland Farms</p>
                                        <p class="text-xs text-gray-400">+94 31 2 212 545</p>
                                        <p class="text-xs text-gray-400">kelaniya@highland.com</p>
                                    </div>
                                    <h1 class="flex-1 m-3 text-3xl font-semibold text-gray-600 text-center">100Kg</h1>
                                </div>

                                <div class="flex items-center">
                                    <h1 class="text-gray-500 font-semibold flex-1">Previous Stock</h1>
                                    <p class="text-gray-500 font-semibold">Yesterday</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        5Kg
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Average Consumtion
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="">
                                        <h1 class="text-gray-600 font-semibold">Oat Milk Low..</h1>
                                        <p class="text-sm text-gray-500 font-bold my-1">Highland Farms</p>
                                        <p class="text-xs text-gray-400">+94 31 2 212 545</p>
                                        <p class="text-xs text-gray-400">kelaniya@highland.com</p>
                                    </div>
                                    <h1 class="flex-1 m-3 text-3xl font-semibold text-gray-600 text-center">0Ltr</h1>
                                </div>

                                <div class="flex items-center">
                                    <h1 class="text-gray-500 font-semibold flex-1">Previous Stock</h1>
                                    <p class="text-gray-500 font-semibold">10th Jul</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        1Ltr
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Average Consumtion
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-red-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="">
                                        <h1 class="text-gray-600 font-semibold">Amiron Whole Chic...</h1>
                                        <p class="text-sm text-gray-500 font-bold my-1">Keels Super</p>
                                        <p class="text-xs text-gray-400">+94 31 2 789 145</p>
                                        <p class="text-xs text-gray-400">vihaga@keelssuper.com</p>
                                    </div>
                                    <h1 class="flex-1 m-3 text-3xl font-semibold text-gray-600 text-center">12Kg</h1>
                                </div>

                                <div class="flex items-center">
                                    <h1 class="text-gray-500 font-semibold flex-1">Previous Stock</h1>
                                    <p class="text-gray-500 font-semibold">Yesterday</p>
                                </div>
                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        8Kg
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Average Consumtion
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->
                        </div>
                    </div>
                </div>


                 <!-- Kitchen -->
                 <div class="moving-part Kitchen glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-7" id="stickyContainerKitchen">
                    <div class="greeting flex w-full justify-between items-center">
                        <h1 class="text-2xl text-gray-700 font-semibold">👩‍🍳 Kitchen</h1>

                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Add Food
                        </button>
                    </div>

                    <div class="warning w-full rounded-xl bg-yellow-500 bg-opacity-30 my-5 flex items-center p-5 transform transition duration-200 hover:shadow-lg hover:scale-95 cursor-pointer">
                        <div class="flex-1">
                            <h1 class="text-2xl font-semibold text-gray-600">Total 5 Foods will disappearing because inventory is running out</h1>
                            <button class="flex items-center text-sm mt-4">
                                Show
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-yellow-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <!-- Search -->

                    <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0 z-50" id="stickySearchKitchen">
                        <input type="text" placeholder="Search for FoodID, Food Name Or Category Name..." class="flex-1 bg-transparent rounded-md border transform transition-colors duration-300">
                        <button class="flex items-center text-gray-500 mx-5 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="filterKitchen">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            Filters
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="exportKitchen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>

                            <div class="border border-gray-600 w-36 h-20 rounded-md absolute -bottom-24 right-0 flex-col shadow-md p-3 bg-gray-100 hidden exportedKitchen">
                                <button class="flex items-center text-gray-500 text-sm border-b border-gray-500 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .xlsx
                                </button>
                                <button class="flex items-center text-gray-500 text-sm mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .doc
                                </button>
                            </div>
                        </div>
                   </div>
                   
                    <div class="flex mt-5 mb-24">
                        <div class="left-delivery flex-1 flex flex-wrap">

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="w-16 h-16 overflow-hidden flex-1">
                                        <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600 font-semibold text-sm">Consist of 12 ingredients</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">Popularity</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, possimus.</p>
                                <h1 class="text-gray-600 font-semibold flex-1">Chicken Burger BBQ Halloween Special</h1>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Low
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Disappearing Status
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->


                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="w-16 h-16 overflow-hidden flex-1">
                                        <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600 font-semibold text-sm">Consist of 09 ingredients</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">Popularity</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, possimus.</p>
                                <h1 class="text-gray-600 font-semibold flex-1">Chicken Burger Reglar (XL)</h1>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-red-500 bg-red-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        High
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Disappearing Status
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-red-400 left-0"></div>
                            </div>

                            <!-- End of card -->


                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="w-16 h-16 overflow-hidden flex-1">
                                        <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600 font-semibold text-sm">Consist of 16 ingredients</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">Popularity</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, possimus.</p>
                                <h1 class="text-gray-600 font-semibold flex-1">Papa's Special Burger Dayya</h1>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-yellow-500 bg-yellow-200 bg-opacity-70 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Medium
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Disappearing Status
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-yellow-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                            <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="w-16 h-16 overflow-hidden flex-1">
                                        <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600 font-semibold text-sm">Consist of 12 ingredients</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">Popularity</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, possimus.</p>
                                <h1 class="text-gray-600 font-semibold flex-1">Chicken Burger BBQ Halloween Special</h1>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Low
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Disappearing Status
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                            <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="w-16 h-16 overflow-hidden flex-1">
                                        <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600 font-semibold text-sm">Consist of 12 ingredients</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">Popularity</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, possimus.</p>
                                <h1 class="text-gray-600 font-semibold flex-1">Chicken Burger BBQ Halloween Special</h1>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Low
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Disappearing Status
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                            <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="w-16 h-16 overflow-hidden flex-1">
                                        <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                                    </div>
                                    <div>
                                        <h1 class="text-gray-600 font-semibold text-sm">Consist of 12 ingredients</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">Popularity</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, possimus.</p>
                                <h1 class="text-gray-600 font-semibold flex-1">Chicken Burger BBQ Halloween Special</h1>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Low
                                    </button>

                                    <div class="text-gray-500 text-xs flex items-center">
                                        Disappearing Status
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        </div>
                    </div>
                </div>


                <!-- Suppliers -->
                <div class="moving-part Suppliers glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-8" id="stickyContainerSuppliers">
                    <div class="greeting flex w-full justify-between items-center">
                        <h1 class="text-2xl text-gray-700 font-semibold">👨‍💼 Suppliers</h1>

                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Add Food
                        </button>
                    </div>

                    <!-- Search -->

                    <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0 z-50" id="stickySearchSuppliers">
                        <input type="text" placeholder="Search for SupplierID, Supplier Name Or Supplied Item..." class="flex-1 bg-transparent rounded-md border transform transition-colors duration-300">
                        <button class="flex items-center text-gray-500 mx-5 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="filterSuppliers">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            Filters
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="exportSuppliers">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>

                            <div class="border border-gray-600 w-36 h-20 rounded-md absolute -bottom-24 right-0 flex-col shadow-md p-3 bg-gray-100 hidden exportedSuppliers">
                                <button class="flex items-center text-gray-500 text-sm border-b border-gray-500 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .xlsx
                                </button>
                                <button class="flex items-center text-gray-500 text-sm mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .doc
                                </button>
                            </div>
                        </div>
                   </div>
                   
                    <div class="flex mt-5 mb-24">
                        <div class="left-delivery flex-1 flex flex-wrap">

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="overflow-hidden w-16 h-16 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="SupplierImage">
                                    </div>
                                    <div class="flex-1 ml-2">
                                        <h1 class="text-gray-600 font-semibold text-sm">All Purpose Flour and 6+ more</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">+94 76 6 108500</p>
                                        <p class="text-xs text-gray-400">sithum@icloud.com</p>
                                        
                                    </div>
                                </div>

                                <h1 class="text-gray-600 font-semibold flex-1">Mr. Sithum Basnayeke</h1>
                                <p class="text-xs text-gray-400 my-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Kandy Road, Badulla
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-500">Rs. 74,000.00</h3>
                                        Total Payments
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->


                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="overflow-hidden w-16 h-16 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="SupplierImage">
                                    </div>
                                    <div class="flex-1 ml-2">
                                        <h1 class="text-gray-600 font-semibold text-sm">Carrots, Olives and 2+ more</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">+94 76 6 108500</p>
                                        <p class="text-xs text-gray-400">contact@randimafruits.com</p>
                                        
                                    </div>
                                </div>

                                <h1 class="text-gray-600 font-semibold flex-1">Randima Fruit House</h1>
                                <p class="text-xs text-gray-400 my-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Eriyawetiya, Kiribathgoda
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-yellow-500 bg-yellow-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-500">Rs. 12,736.00</h3>
                                        Total Payments
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-yellow-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="overflow-hidden w-16 h-16 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="SupplierImage">
                                    </div>
                                    <div class="flex-1 ml-2">
                                        <h1 class="text-gray-600 font-semibold text-sm">Fresh Milk</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">+94 76 6 108500</p>
                                        <p class="text-xs text-gray-400">contact@highland.com</p>
                                        
                                    </div>
                                </div>

                                <h1 class="text-gray-600 font-semibold flex-1">Highland Milk Products</h1>
                                <p class="text-xs text-gray-400 my-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    No.45, Viharagoda, Kiribathgoda
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-red-500 bg-red-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Out
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-500">Rs. 68,000.00</h3>
                                        Total Payments
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-red-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="flex items-center flex-1 mb-2">
                                    <div class="overflow-hidden w-16 h-16 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="SupplierImage">
                                    </div>
                                    <div class="flex-1 ml-2">
                                        <h1 class="text-gray-600 font-semibold text-sm">Carrots, Olives and 2+ more</h1>
                                        <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                        <p class="text-xs text-gray-400">+94 76 6 108500</p>
                                        <p class="text-xs text-gray-400">contact@randimafruits.com</p>
                                        
                                    </div>
                                </div>

                                <h1 class="text-gray-600 font-semibold flex-1">Randima Fruit House</h1>
                                <p class="text-xs text-gray-400 my-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Eriyawetiya, Kiribathgoda
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-yellow-500 bg-yellow-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col">
                                        <h3 class="text-xl font-semibold text-gray-500">Rs. 12,736.00</h3>
                                        Total Payments
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-yellow-400 left-0"></div>
                            </div>

                            <!-- End of card -->


                       

                        </div>
                    </div>
                </div>


                <!-- Crew -->
                <div class="moving-part Crew glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-9" id="stickyContainerCrew">
                    <div class="greeting flex w-full justify-between items-center">
                        <h1 class="text-2xl text-gray-700 font-semibold">👨‍👨‍👦‍👦 Crew</h1>

                        <button class="flex ml-5 px-4 py-3 bg-black text-gray-200 rounded-full hover:shadow-xl transform transition duration-150 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                                Recruit Employee
                        </button>
                    </div>

                    <!-- Search -->
                    <div class="relative h-12 shadow-md mx-auto mt-5" style="width: 80%;">
                       <ul class="flex items-center h-full">
                           <li class="option-crew all-orders block h-full text-center text-yellow-500 font-bold cursor-pointer transform transition-colors duration-500" style="width: 33%;">All Employees</li>
                           <li class="option-crew completed block h-full text-center text-gray-500 cursor-pointer transform transition-colors duration-500" style="width: 33%;">Day</li>
                           <li class="option-crew completed block h-full text-center text-gray-500 cursor-pointer transform transition-colors duration-500" style="width: 33%;">Night</li>
                       </ul>
                       <span class="underline-slide-crew absolute bottom-0 left-0 h-1 bg-yellow-400 transform transition-all duration-500 rounded-xl" style="width: 33%;"></span>
                   </div>

                    <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0 z-50" id="stickySearchCrew">
                        <input type="text" placeholder="Search for EmployeeID, Employee Name Or Shift..." class="flex-1 bg-transparent rounded-md border transform transition-colors duration-300">
                        <button class="flex items-center text-gray-500 mx-5 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="filterCrew">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            Filters
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 bg-transparent px-3 py-2 rounded-md transform transition-colors duration-300" id="exportCrew">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>

                            <div class="border border-gray-600 w-36 h-20 rounded-md absolute -bottom-24 right-0 flex-col shadow-md p-3 bg-gray-100 hidden exportedCrew">
                                <button class="flex items-center text-gray-500 text-sm border-b border-gray-500 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .xlsx
                                </button>
                                <button class="flex items-center text-gray-500 text-sm mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                    </svg>
                                    Export as .doc
                                </button>
                            </div>
                        </div>
                   </div>
                   
                    <div class="flex mt-5 mb-24">
                        <div class="left-delivery flex-1 flex flex-wrap">

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-64 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="absolute top-2 right-2 rounded-full px-3 py-1 bg-black text-gray-200 text-sm bg-opacity-60">Day</div>
                                <div class="flex justify-center mb-2">
                                    <div class="overflow-hidden w-24 h-24 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="SupplierImage">
                                    </div>
                                </div>
                                
                                <h1 class="text-gray-600 font-semibold text-center text-lg">Mr. Sithum Basnayake</h1>
                                <div class="my-1 text-center">
                                    <h1 class="text-gray-500 font-semibold text-sm mb-1">Manager</h1>
                                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                    <p class="text-xs text-gray-400">+94 76 6 108500</p>
                                    <p class="text-xs text-gray-400">sithum@icloud.com</p>
                                    
                                </div>
                                <p class="text-xs text-gray-400 mb-1 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Kandy Road, Badulla
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col text-right">
                                        <h3 class="text-xl font-semibold text-gray-500 text-left">Rs. 74,000.00</h3>
                                        Total Salary - Every 30th
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->


                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-64 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                            <div class="absolute top-2 right-2 rounded-full px-3 py-1 bg-black text-gray-200 text-sm bg-opacity-60">Night</div>
                                <div class="flex justify-center mb-2">
                                    <div class="overflow-hidden w-24 h-24 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/Mayuko.jpg" alt="SupplierImage">
                                    </div>
                                </div>
                                
                                <h1 class="text-gray-600 font-semibold text-center text-lg">Mrs. Mayuko Inoiue</h1>
                                <div class="my-1 text-center">
                                    <h1 class="text-gray-500 font-semibold text-sm mb-1">Chief Chef</h1>
                                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                    <p class="text-xs text-gray-400">+94 71 4 123 456</p>
                                    <p class="text-xs text-gray-400">mayuko@icloud.com</p>
                                    
                                </div>
                                <p class="text-xs text-gray-400 mb-1 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Kandy Road, Badulla
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col text-right">
                                        <h3 class="text-xl font-semibold text-gray-500 text-left">Rs. 124,000.00</h3>
                                        Total Salary - Every 15th
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        </div>
                    </div>
                </div>


                 <!-- Settings -->
                 <div class="moving-part Settings glass rounded-3xl p-7 overflow-y-auto h-full absolute top-0 right-0 left-0 z-9" id="stickyContainerCrew">
                    <div class="greeting flex w-full justify-between items-center">
                        <h1 class="text-2xl text-gray-700 font-semibold">🛠 Settings</h1>
                    </div>

                    <!-- Search -->
                    <div class="relative h-12 shadow-md mx-auto mt-5" style="width: 80%;">
                       <ul class="flex items-center h-full">
                           <li class="option-crew all-orders block h-full text-center text-yellow-500 font-bold cursor-pointer transform transition-colors duration-500" style="width: 33%;">All Settings</li>
                           <li class="option-crew completed block h-full text-center text-gray-500 cursor-pointer transform transition-colors duration-500" style="width: 33%;">Account</li>
                           <li class="option-crew completed block h-full text-center text-gray-500 cursor-pointer transform transition-colors duration-500" style="width: 33%;">Backup</li>
                       </ul>
                       <span class="underline-slide-crew absolute bottom-0 left-0 h-1 bg-yellow-400 transform transition-all duration-500 rounded-xl" style="width: 33%;"></span>
                   </div>

                    <!-- Search Field -->
                   <div class="mt-5 flex items-center w-full sticky top-0 z-50" id="stickySearchCrew">
                        <input type="text" placeholder="Search for Settings..." class="flex-1 bg-transparent rounded-md border transform transition-colors duration-300 mx-16">
                        
                   </div>
                   
                    <div class="flex mt-5 mb-24">
                        <div class="left-delivery flex-1 flex flex-wrap">

                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-64 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                                <div class="absolute top-2 right-2 rounded-full px-3 py-1 bg-black text-gray-200 text-sm bg-opacity-60">Day</div>
                                <div class="flex justify-center mb-2">
                                    <div class="overflow-hidden w-24 h-24 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/611bf48f3a44a2.49241929.png" alt="SupplierImage">
                                    </div>
                                </div>
                                
                                <h1 class="text-gray-600 font-semibold text-center text-lg">Mr. Sithum Basnayake</h1>
                                <div class="my-1 text-center">
                                    <h1 class="text-gray-500 font-semibold text-sm mb-1">Manager</h1>
                                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                    <p class="text-xs text-gray-400">+94 76 6 108500</p>
                                    <p class="text-xs text-gray-400">sithum@icloud.com</p>
                                    
                                </div>
                                <p class="text-xs text-gray-400 mb-1 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Kandy Road, Badulla
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col text-right">
                                        <h3 class="text-xl font-semibold text-gray-500 text-left">Rs. 74,000.00</h3>
                                        Total Salary - Every 30th
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->


                        <!-- Single Card -->
                            <div class="card-delivery mb-4 w-64 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
                            
                            <div class="absolute top-2 right-2 rounded-full px-3 py-1 bg-black text-gray-200 text-sm bg-opacity-60">Night</div>
                                <div class="flex justify-center mb-2">
                                    <div class="overflow-hidden w-24 h-24 rounded-full mb-1 cursor-pointer mr-2">
                                        <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/users/Mayuko.jpg" alt="SupplierImage">
                                    </div>
                                </div>
                                
                                <h1 class="text-gray-600 font-semibold text-center text-lg">Mrs. Mayuko Inoiue</h1>
                                <div class="my-1 text-center">
                                    <h1 class="text-gray-500 font-semibold text-sm mb-1">Chief Chef</h1>
                                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                                    <p class="text-xs text-gray-400">+94 71 4 123 456</p>
                                    <p class="text-xs text-gray-400">mayuko@icloud.com</p>
                                    
                                </div>
                                <p class="text-xs text-gray-400 mb-1 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>    
                                    Kandy Road, Badulla
                                </p>

                                <div class="flex items-center mt-2 justify-between">
                                    <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No Due
                                    </button>

                                    <div class="text-gray-500 text-xs flex flex-col text-right">
                                        <h3 class="text-xl font-semibold text-gray-500 text-left">Rs. 124,000.00</h3>
                                        Total Salary - Every 15th
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
                            </div>

                            <!-- End of card -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="./scripts/navigation.js"></script>
    <script src="./scripts/ordersNavigator.js"></script>
    <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

console.log(myChart);
</script>
</body>
</html>