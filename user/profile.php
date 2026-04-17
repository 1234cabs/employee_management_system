<?php 
include '../connection/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee'){
    header("Location: ../login.php");
}

$id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$GetData = $stmt->get_result()->fetch_assoc(); 
?>
<?php include '../template/header.php'; ?>

<?php include '../alert.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card custom-shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">

        <h3 class="text-center mb-4 text-danger">MY PROFILE</h3>
        <div class="card" style="width: 22rem;">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <div class="card-body">
                <h5 class="card-title text-center text-success">INFORMATION</h5>
                <hr>
                <!-- FULLNAME -->
                <tr>
                    <th><b>FULL NAME:</b> </th>
                </tr>
                <tr>
                    <th><?= $GetData['fullname']; ?></th>
                </tr>
                <hr>

                <!-- EMAIL -->
                <tr>
                    <th><b>EMAIL:</b> </th>
                </tr>
                <tr>
                    <th><?= $GetData['email']; ?></th>
                </tr>
                <hr>

                <!-- CONTACT -->
                <tr>
                    <th><b>CONTACT:</b> </th>
                </tr>
                <tr>
                    <th><?= $GetData['contact']; ?></th>
                </tr>
                <hr>

                <!-- POSITION -->
                <tr>
                    <th><b>POSITION:</b> </th>
                </tr>
                <tr>
                    <th><?= $GetData['position']; ?></th>
                </tr>
                <hr>

                <!-- ROLE -->
                <tr>
                    <th><b>ROLE:</b> </th>
                </tr>
                <tr>
                    <th><?= $GetData['role']; ?></th>
                </tr>
                <hr>

                <!-- Username -->
                <tr>
                    <th><b>USERNAME:</b> </th>
                </tr>
                <tr>
                    <th><?= $GetData['username']; ?></th>
                </tr>
                <hr>

                <br>
                <br>
                <a href="user.php" class="btn btn-primary" style="width: 100%;">VIEW ALL EMPLOYEE</a>
            </div>
        </div>

    </div>

</div>

<?php include '../template/footer.php'; ?>