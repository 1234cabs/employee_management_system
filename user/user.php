<?php 
include '../connection/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee'){
    header("Location: ../login.php");
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
            $stmt = $conn->prepare("SELECT * FROM users ORDER BY date DESC");
            $stmt->execute();
            $getUsers = $stmt->get_result();

            if($getUsers->num_rows > 0):

            while($row = $getUsers->fetch_assoc()):
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
            <?php endwhile; 
            else:
            ?>
            <tr>
                <td colspan="9" class="text-danger text-center">No Data Found</td>
            </tr>
            <?php endif; ?>
        </table>

    </div>

</div>





<?php include '../template/footer.php'; ?>