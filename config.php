<?php


$host = "sql103.infinityfree.com";  
$dbname = "if0_38016213_ce";  
$username = "if0_38016213"; 
$password = "8JjqXi7hdh1BG";  


$conn = new mysqli($host, $username, $password, $dbname);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>