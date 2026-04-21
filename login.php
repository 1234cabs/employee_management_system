<?php 
include 'connection/db.php';
include 'session/session.php';

if(isset($_SESSION['user_id'])){
    if(isset($_SESSION['role']) == 'admin'){
        header("Location: admin/admin.php");
    }else{
        header("Location: user/profile.php");
    }
}

if(isset($_POST['login'])) {
    $Uname = $_POST['username'];
    $pass = $_POST['password'];

    if(empty($Uname) || empty($pass)){
        $_SESSION['error'] = "All Feilds Are Required!";
        header("Location: ". $_SERVER["PHP_SELF"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username=?");
    $stmt->bind_param("s", $Uname);
    $stmt->execute();
    $GetUser = $stmt->get_result();
    if($row = $GetUser->fetch_assoc()){
        if(password_verify($pass,$row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if($_SESSION['role'] == 'admin'){
                $_SESSION['success'] = "Welcome To Admin Dashboard!";
                header("Location: admin/admin.php");
                exit;
            }else{
                $_SESSION['success'] = "Welcome To Employee Dashboard!";
                header("Location: user/profile.php");
                exit;
            }
        }else{
            $_SESSION['error'] = "Incorrect Password!";
            header("Location: ". $_SERVER["PHP_SELF"]);
            exit;
        }
    }else{
        $_SESSION['error'] = "This Username is Not Registered!";
        header("Location: ". $_SERVER["PHP_SELF"]);
        exit;
    }
}
?>
            
<?php include 'template/header.php'; ?>

<?php include 'alert.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card custom-shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">

        <h3 class="text-center mb-4">Login Form</h3>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                <div class="form-text">We'll never share your email.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>

        </form>

    </div>

</div>

<?php include 'template/footer.php'; ?>