<?php
$servername = "localhost";
$username = "cust_01";
$password = "password";
$database = "shop"

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 