<?php 
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "employee";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Connection Failed: ". $conn->connect_errno);
}

?>