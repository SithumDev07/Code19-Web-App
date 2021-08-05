<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "startupx";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die('Conncection Failed' . $conn->connect_error);
