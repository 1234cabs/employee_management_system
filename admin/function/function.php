<?php 
include '../../connection/db.php';

if(isset($_POST['create'])) {
    $Fname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $Uname = trim($_POST['username']);
    $pos = trim($_POST['position']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);

    if(empty($Fname) || empty($email) || empty($contact) || empty($Uname) || 
    empty($pos) || empty($role) || empty($password)){
        $_SESSION['error'] = "All Feilds Are Required!";
        header("Location: ../admin.php");
        exit;
    }

    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $GetEmail = $stmt->get_result();
    if($GetEmail->num_rows > 0){
        $_SESSION['error'] = "Email is Already Exist!";
        header("Location: ../admin.php");
        exit;
    }
    
    $stmt = $conn->prepare("INSERT INTO users (fullname,email,contact,
    username,position,role,password) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $Fname,$email,$contact,$Uname,$pos,$role,$pass);
    $stmt->execute();
    $_SESSION['success'] = "New Employee Added Successfully!";
    header("Location: ../admin.php");
    exit;

}

//UPDATE
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $Fname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $Uname = $_POST['username'];
    $pos =  $_POST['position'];

    if(empty($Fname) || empty($email) || empty($contact) || empty($Uname) || empty($pos)){
        $_SESSION['error'] = "All Feilds Are Required!";
        header("Location: ../admin.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND id<>?");
    $stmt->bind_param("si", $email,$id);
    $stmt->execute();
    $ExistEmail = $stmt->get_result();
    if($ExistEmail->num_rows > 0){
        $_SESSION['error'] = "This Email is Already Used!";
        header("Location: ../admin.php");
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET fullname=?,email=?,contact=?,username=?,position=? WHERE id=?");
    $stmt->bind_param("sssssi", $Fname,$email,$contact,$Uname,$pos,$id);
    $stmt->execute();
    if($stmt->affected_rows == 0){
        $_SESSION['error'] = "No Changes Made";
    }else{
        $_SESSION['success'] = "This Record Successfully Update!";
    }

    header("Location: ../admin.php");
    exit;
}

//DELETE

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$_SESSION['success'] = "This Record Successfully Deleted!";
header("Location: ../admin.php");

?>