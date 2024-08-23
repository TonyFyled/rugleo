<?php
$servername = 'localhost';
$dbname = 'wallet_checker';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn){
        die("connection Failed : " . mysqli_connect_error());
    }else{
        echo "Connected successfully";
    }
?>