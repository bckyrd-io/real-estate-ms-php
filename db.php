<?php

// Database credentials
$host = 'localhost';
$dbname = 'real__estate';
$username = 'root';
$password = '';

// Create a PDO instance (PHP Data Objects)
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Display a success message for debugg only
// echo "Connected to the database successfully.";

?>
