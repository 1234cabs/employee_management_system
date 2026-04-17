<?php 
session_start();

function requiredLogin() {
    if(!isset($_SESSION['users'])){
        header("Location: ../login.php");
        exit;
    }
}
 
function requiredRole($role){
    if(!isset($_SESSION['users']) || $_SESSION['role'] !== $role){
        header("Location: ../login.php");
        exit;
    }
}
?>