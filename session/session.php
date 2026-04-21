<?php 

function RequiredLogin() {
    if(!isset($_SESSION['user_id'])){
        header("Location: ../login.php");
    }
}

function RequiredRole($role) {
    if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== $role){
        header("Location: ../login.php");
    }
}

?>