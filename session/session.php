<?php 

// function RequiredLogin(){
//     if(!isset($_SESSION['user_id'])){
//         header("Location: ../login.php");     
//     }
// }

// function RequiredRole($role){
//     if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== $role){
//         header("Location: ../login.php");
//     }
// }

// function RequiredLogin(){
//     if(!isset($_SESSION['user_id'])){
//         header("Location: ../login.php");
//         exit;
//     }
// }

// function RequiredRole($role){
//     if(!isset($_SESSION['user_id'])){
//         header("Location: ../login.php");
//         exit;
//     }

//     if($_SESSION['role'] !== $role){
//         // redirect based sa role
//         if($_SESSION['role'] === 'employee'){
//             header("Location: ../user/profile.php");
//         } elseif($_SESSION['role'] === 'admin'){
//             header("Location: ../admin/admin.php");
//         } else {
//             header("Location: ../login.php");
//         }
//         exit;
//     }
// }

function RequiredLogin(){
    if(!isset($_SESSION['user_id'])){
        header("Location: ../login.php");
        exit;
    }
}

function RequiredRole($role){
    if(!isset($_SESSION['user_id'])){
        header("Location: ../login.php");
        exit;
    }

    if($_SESSION['role'] !== $role){
        if($_SESSION['role'] === 'admin'){
            header("Location: ../admin/admin.php");
        }elseif($_SESSION['role'] === 'employee'){
            header("Location: ../user/profile.php");
        }else{
            header("Location: ../login.php");
        }
    }
}
?>