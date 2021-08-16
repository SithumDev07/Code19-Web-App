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
    </style>
</head>
<body>
    <main class="flex glass h-screen overflow-hidden">
        <aside class="hidden xl:flex flex-col border w-72 p-5 h-screen overflow-hidden">
            <div>
                <h1 class="text-center font-semibold text-3xl text-blue-600">Dashboard</h1>
                <div class="flex flex-col items-center mt-4 2xl:mt-6">
                    <div class="overflow-hidden w-20 h-20 rounded-full mb-1 border-2 border-blue-600 p-1 cursor-pointer">
                        <img class="w-full h-full object-cover rounded-full" src="https://images.unsplash.com/photo-1627660692856-bc032e058cc2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
                    </div>
                <h2 class="text-base font-semibold text-gray-500">Bella</h2>
                <h4 class="text-sm font-light text-gray-500">Manager</h4>
                </div>
            </div>

            <nav class="overflow-y-auto flex-1 mt-6 flex flex-col side-nav justify-between">
                <ul>
                    <li>
                        <button class="flex w-full px-4 rounded-lg bg-gray-900 py-3 mb-4 text-gray-200 transform transition duration-200 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Dashboard
                        </button>
                    </li>
                    <li>
                        <button class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4 transform transition duration-300 hover:bg-gray-900 hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                              </svg>
                            Orders
                        </button>
                    </li>
                    <li class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                          </svg>
                        Deliveries
                    </li>
                    <li class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                          </svg>
                        Inventory
                    </li>
                    <li class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4">
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
                    </li>
                    <li class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                          </svg>
                        Suppliers
                    </li>
                    <li class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4">
                        <svg class="mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 11C10.2091 11 12 9.20914 12 7C12 4.79086 10.2091 3 8 3C5.79086 3 4 4.79086 4 7C4 9.20914 5.79086 11 8 11ZM8 9C9.10457 9 10 8.10457 10 7C10 5.89543 9.10457 5 8 5C6.89543 5 6 5.89543 6 7C6 8.10457 6.89543 9 8 9Z" fill="currentColor" /><path d="M11 14C11.5523 14 12 14.4477 12 15V21H14V15C14 13.3431 12.6569 12 11 12H5C3.34315 12 2 13.3431 2 15V21H4V15C4 14.4477 4.44772 14 5 14H11Z" fill="currentColor" /><path d="M22 11H16V13H22V11Z" fill="currentColor" /><path d="M16 15H22V17H16V15Z" fill="currentColor" /><path d="M22 7H16V9H22V7Z" fill="currentColor" /></svg>
                        Crew
                    </li>
                    <li class="flex w-full px-4 rounded-lg cursor-pointer py-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                        Settings
                    </li>
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

            <div class="moving-part glass rounded-3xl p-5 overflow-y-auto h-screen container mx-auto">
                <div class="greeting flex w-full justify-between items-center">
                    <h1 class="text-2xl text-gray-700 font-semibold">👋 Hello, Bella</h1>
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
        </section>
    </main>
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