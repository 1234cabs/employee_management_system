<?php 
include '../connection/db.php'; 
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee'){
    header("Location: ../login.php");
    exit;
}
?>
<?php include '../template/header.php'; ?>

<?php include '../template/navbar.php'; ?>

<div class="container mt-4">

    <?php include '../alert.php'; ?>

    <a href="profile.php" class="btn btn-success my-3">BACK</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped text-center">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>FULL NAME</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>USERNAME</th>
                    <th>POSITION</th>
                    <th>ROLE</th>
                    <th>DATE ADDED</th>
                 
                </tr>
            </thead>
            <?php 
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()):
            ?>
            <tbody>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['fullname']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['position']; ?></td>
                    <td><?= $row['role']; ?></td>
                    <td><?= $row['date']; ?></td>
                 
                </tr>
            </tbody>
            <?php endwhile; ?>

        </table>
    </div>

</div>





<?php include '../template/footer.php'; ?>