<?php
$conn = mysqli_connect("localhost", "root", "", "avinash_travel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>