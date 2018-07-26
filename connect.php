<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "users";
// Create connection 
$conn = new mysqli($host, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
if (!($stmt = $conn->prepare("SELECT Username,Password,Priviledge FROM userlist WHERE Username=? AND Password=?"))) { 
	die("Preparation failed: " . $conn->error); #prepared statments 
}
?>